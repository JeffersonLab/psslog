<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $primaryKey = 'attachment_id';

    protected $table = 'attachments';

    public $timestamps = false;

    public function psslog()
    {
        return $this->belongsTo(\App\Models\Psslog::class, 'psslog_id', 'psslog_id');
    }
}
