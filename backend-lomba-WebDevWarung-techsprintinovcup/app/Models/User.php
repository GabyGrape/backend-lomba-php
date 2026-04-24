<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // <--- WAJIB UNTUK API TOKEN

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    // Hubungkan model ini ke tabel users_ (kustom kamu)
    protected $table = 'users_';

    /**
     * Atribut yang boleh diisi secara massal.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',      // Tambahkan role karena ada di migration kamu
        'is_active',  // Tambahkan is_active
    ];

    /**
     * Atribut yang harus disembunyikan saat data dikirim (JSON).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting tipe data otomatis.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            // 'password' => 'hashed', // COMMENT baris ini jika kamu masih mau pakai plain text sementara
            'is_active' => 'boolean',
        ];
    }
}