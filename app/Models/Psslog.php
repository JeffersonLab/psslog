<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

class Psslog extends Model
{
    // properties that differ from standard Laravel conventions
    protected $primaryKey = 'psslog_id';

    protected $table = 'psslog';

    public $timestamps = false;

    protected $stamp = null;

    // Attributes which may not be mass-assigned
    public $guarded = ['psslog_id'];

    // Always retrieve with the entrymaker
    public $with = ['entryMaker'];

    // Default validation rules
    public static $rules = [
        'title' => 'required|max:255',
        'entry_timestamp' => 'required|date',
        'entry_type' => 'required|in:AUTO,INFO,STAMP,ACCESS',
        'comments' => 'max:4000',
        'Area' => 'required',
    ];

    protected function casts(): array
    {
        return [
            'entry_timestamp' => 'datetime',
        ];
    }

    public function getCreatedAtColumn()
    {
        return 'entry_timestamp';
    }

    public function hasStamp(): bool
    {
        if ($this->entry_type == 'STAMP') {
            return Stamp::where('psslog_id', $this->psslog_id)->exists();
        }

        return false;
    }

    public function stampType(): ?string
    {
        if ($this->entry_type == 'STAMP') {
            return Stamp::where('psslog_id', $this->psslog_id)->pluck('stamp_type')->first();
        }

        return null;
    }

    public function stamp(): ?Stamp
    {
        if ($this->hasStamp()) {
            if (! $this->stamp) {
                $this->stamp = Stamp::where('psslog_id', $this->psslog_id)->first();
            }
        } else {
            $this->stamp = null;
        }

        return $this->stamp;
    }

    public function entryMaker(): HasOne
    {
        return $this->hasOne(\App\Models\User::class, 'staff_id', 'entry_maker');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(\App\Models\Attachment::class, 'psslog_id', 'psslog_id');
    }

    public function imageAttachments(): Collection
    {
        return $this->attachments->where(function ($item) {
            return stristr($item->mime_type, 'image') !== false;
        });
    }

    public function hasImageAttachments(): bool
    {
        return $this->imageAttachments()->isNotEmpty();
    }

    public function hasAttachments(): bool
    {
        return $this->attachments->isNotEmpty();
    }
}
