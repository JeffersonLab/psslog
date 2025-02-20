<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stamp extends Model
{
    // properties that differ from standard Laravel conventions
    protected $primaryKey = 'psslog_id';
    protected $table = 'stamps';
    public $timestamps = false;


    public function type() {
        return $this->getAttribute('stamp_type');
    }

    public function hasData() : bool {
        switch($this->type()){
            case 'CONTROLLED'   : return $this->hasControlledAccessData();
            case 'RESTRICTED'   : return $this->hasRestrictedAccessData();
            case 'SWEEP'        : return $this->hasSweepStampData();
            case 'BEAM'         :
            case 'POWER'        :
            default             :    return false;
        }
    }

    public function data(): ?Model {
        switch($this->type()){
            case 'CONTROLLED'   : return $this->controlledAccessData();
            case 'RESTRICTED'   : return $this->restrictedAccessData();
            case 'SWEEP'        : return $this->sweepData();
            case 'BEAM'         :
            case 'POWER'        :
            default             : return null;
        }
    }

    protected function controlledAccessData() {
        return ControlledAccessStamp::where('psslog_id', $this->psslog_id)->first();
    }

    protected function restrictedAccessData() {
        return RestrictedAccessStamp::where('psslog_id', $this->psslog_id)->first();
    }

    protected function sweepData() {
        return SweepStamp::where('psslog_id', $this->psslog_id)->first();
    }

    protected function hasControlledAccessData() {
        return ControlledAccessStamp::where('psslog_id', $this->psslog_id)->exists();
    }

    protected function hasRestrictedAccessData() {
        return RestrictedAccessStamp::where('psslog_id', $this->psslog_id)->exists();
    }

    protected function hasSweepData() {
        return SweepStamp::where('psslog_id', $this->psslog_id)->exists();
    }

    /**
     * The Survey_required field used in several stamp types
     * uses the characters F/P/N (Full, Partial, None)
     * This function returns the string representation rather
     * than the single char.
     *
     * @return string  single char 'Full', 'Partial', or 'None'
     */
    public static function expandFPN($val)
    {
        if (strtoupper($val) == 'F') {return 'Full';}
        if (strtoupper($val) == 'P') {return 'Part';}
        if (strtoupper($val) == 'N') {return 'None';}
        return '';
    }
}
