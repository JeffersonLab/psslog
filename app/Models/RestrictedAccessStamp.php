<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestrictedAccessStamp extends Model
{
    // properties that differ from standard Laravel conventions
    protected $primaryKey = 'psslog_id';

    protected $table = 'restricted_access_stamps';

    public $timestamps = false;

    // Default validation rules
    public static $rules = [
        'survey_required' => 'nullable | in:F,P',
        'announce15' => 'date',
        'announce05' => 'date',
        'survey_completed' => 'date',
    ];

    protected function casts(): array
    {
        return [
            'announce15' => 'datetime',
            'announce05' => 'datetime',
            'survey_completed' => 'datetime',
        ];
    }
}
