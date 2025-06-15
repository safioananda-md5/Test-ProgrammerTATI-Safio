<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Kolom yang dapat diisi
    protected $fillable = [
        'role_id',
        'name',
        'nip',
        'password',
        'address',
        'phone_number',
    ];

    // Kolom yang disembunyikan saat di-serialize (misalnya saat API)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Tipe data casting otomatis
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relasi: User milik satu Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}