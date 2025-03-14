<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Access extends Model
{
    // properties that differ from standard Laravel conventions
    protected $primaryKey = 'psslog_id';

    protected $table = 'accesses';

    protected $with = ['psslog'];

    public $timestamps = false;

    /**
     * Maps key letters to Area names
     * //TODO BSY vs. Hall B
     */
    private $map = ['I' => 'INJ', 'N' => 'NL', 'S' => 'SL', 'B' => 'BSY',
        'A' => 'HALLA', 'B' => 'HALLB', 'C' => 'HALLC',
        'D' => 'HALLD', 'T' => 'HDTAGGER', 'F' => 'LERF'];

    protected function casts(): array
    {
        return [
            'time_in' => 'datetime',
            'time_out' => 'datetime',
        ];
    }

    /**
     * The informational psslog entry that owns the Access
     */
    public function psslog(): BelongsTo
    {
        return $this->belongsTo(Psslog::class, 'psslog_id', 'psslog_id');
    }

    // TODO Figure out Users/SSO Table business

    /**
     * The SSO who signed the user in
     */
    public function entrySso(): HasOne
    {
        return $this->hasOne(\App\Models\User::class, 'staff_id', 'sso_in');
    }

    /**
     * The SSO who signed the user out
     */
    public function exitSso(): HasOne
    {
        return $this->hasOne(\App\Models\User::class, 'staff_id', 'sso_out');
    }
}
