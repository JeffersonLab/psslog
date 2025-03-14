<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = 'v_sso';

    protected $primaryKey = 'staff_id';

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function fLastName()
    {
        $f = isset($this->firstname) ? substr($this->firstname, 0, 1) : '';
        $last = isset($this->lastname) ? $this->lastname : '';

        return "{$f}_{$last}";
    }

    public function lastFirst()
    {
        $first = isset($this->firstname) ?$this->firstname : '_';
        $last = isset($this->lastname) ? $this->lastname : '';
        if ($last){
            return "{$last}, {$first}";
        }
        return $first;
    }
}
