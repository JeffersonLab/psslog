<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attachment extends Model
{
    protected $primaryKey = 'attachment_id';

    protected $table = 'attachments';

    public $timestamps = false;

    public function psslog(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Psslog::class, 'psslog_id', 'psslog_id');
    }
}
