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

    // Tambahkan di bagian atas model User
protected $appends = ['qris_url', 'role'];

public function getRoleAttribute()
{
    // Mengambil nama dari relasi role
    return $this->role()->first()?->name;
}
// Tambahkan method ini di dalam class User
    /**
     * Atribut yang boleh diisi secara massal.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'role_id',     // Tambahkan role karena ada di migration kamu
        'is_active',  // Tambahkan is_active
        'nama_warung',
        'alamat_warung',
        'qris_path'
    ];

    /**
     * Atribut yang harus disembunyikan saat data dikirim (JSON).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

// Helper untuk cek role (sangat berguna untuk proteksi API)
public function hasRole($roleName)
{
    return $this->role->name === $roleName;
}

    public function getQrisUrlAttribute()
{
    return $this->qris_path ? url('storage/' . $this->qris_path) : null;
}
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