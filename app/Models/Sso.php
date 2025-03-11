<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sso extends Model
{
    // properties that differ from standard Laravel conventions
    protected $primaryKey = 'staff_id';

    protected $table = 'v_sso';

    // Attributes which may not be mass-assigned
    public $guarded = [];

    // Default validation rules
    public static $rules = [
        'staff_id' => 'required|integer',
    ];
}
