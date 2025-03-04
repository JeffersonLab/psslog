<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeamPermitStamp extends Model
{
    // properties that differ from standard Laravel conventions
    protected $primaryKey = 'psslog_id';
    protected $table = 'beam_permit_stamps';
    public $timestamps = false;

    // Default validation rules
    public static $rules = [
        'beam_permit_signs' => 'nullable | in:Y,P,I',
        'beam_auth' => 'nullable | in:0,1',
    ];

}
