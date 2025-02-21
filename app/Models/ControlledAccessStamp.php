<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ControlledAccessStamp extends Model
{
    // properties that differ from standard Laravel conventions
    protected $primaryKey = 'psslog_id';
    protected $table = 'controlled_access_stamps';
    public $timestamps = false;

    public function accesses(){
        return $this->hasMany(Access::class, 'owning_stamp_id', 'psslog_id');
    }

}
