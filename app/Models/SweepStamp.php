<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SweepStamp extends Model
{
    // properties that differ from standard Laravel conventions
    protected $primaryKey = 'psslog_id';
    protected $table = 'sweep_stamps';
    public $timestamps = false;
}
