<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestrictedAccessStamp extends Model
{
    // properties that differ from standard Laravel conventions
    protected $primaryKey = 'psslog_id';
    protected $table = 'restricted_access_stamps';
    public $timestamps = false;
}
