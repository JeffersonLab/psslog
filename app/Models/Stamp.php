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

    public function hasSampData() : bool {
        switch($this->type()){
            case 'CONTROLLED'   : return $this->hasControlledAccessStampData();
            case 'RESTRICTED'   : return $this->hasRestrictedAccessStampData();
            case 'SWEEP'        : return $this->hasSweepStampData();
            case 'BEAM'         :
            case 'POWER'        :
            default             :    return false;
        }
    }

    public function stampData(): ?Model {
        switch($this->type()){
            case 'CONTROLLED'   : return $this->controlledAccessStampData();
            case 'RESTRICTED'   : return $this->restrictedAccessStampData();
            case 'SWEEP'        : return $this->sweepStampData();
            case 'BEAM'         :
            case 'POWER'        :
            default             : return null;
        }
    }

    protected function controlledAccessStampData() {
        return ControlledAccessStamp::where('psslog_id', $this->psslog_id)->first();
    }

    protected function restrictedAccessStampData() {
        return RestrictedAccessStamp::where('psslog_id', $this->psslog_id)->first();
    }

    protected function sweepStampData() {
        return SweepStamp::where('psslog_id', $this->psslog_id)->first();
    }

    protected function hasControlledAccessStampData() {
        return ControlledAccessStamp::where('psslog_id', $this->psslog_id)->exists();
    }

    protected function hasRestrictedAccessStampData() {
        return RestrictedAccessStamp::where('psslog_id', $this->psslog_id)->exists();
    }

    protected function hasSweepStampData() {
        return SweepStamp::where('psslog_id', $this->psslog_id)->exists();
    }
}
