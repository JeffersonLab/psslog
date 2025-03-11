<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SweepStamp extends Model
{
    // properties that differ from standard Laravel conventions
    protected $primaryKey = 'psslog_id';

    protected $table = 'sweep_stamps';

    public $timestamps = false;

    protected $casts = [
        'announce15' => 'datetime',
        'announce05' => 'datetime',
        'sweep_completed' => 'datetime',
        'survey_completed' => 'datetime',
    ];

    // Default validation rules
    public static $rules = [
        'survey_required' => 'nullable | in:F,P',
        'radcon_checklist' => 'nullable | in:0,1',
        'announce15' => 'date',
        'announce05' => 'date',
        'sweep_completed' => 'date',
        'survey_completed' => 'date',
        'sweeper_tld_odh' => 'required | in:Y,N',
    ];
}
