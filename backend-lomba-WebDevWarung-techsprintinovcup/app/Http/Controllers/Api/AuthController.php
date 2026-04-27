<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            // Pastikan menunjuk ke tabel users_
            'email' => 'required|string|email|unique:users_,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:pedagang,konsumen,user,admin,developer' // Validasi sesuai Enum
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => $fields['password'], // Masih Plain Text sesuai diskusi
            'role' => $fields['role'],
            'is_active' => true // Set default aktif saat daftar
        ]);

        // Membuat Token menggunakan Sanctum
        $token = $user->createToken('warungtoken')->plainTextToken;

        return response([
            'message' => 'Registrasi Berhasil',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        // Cari user di tabel users_
        $user = User::where('email', $fields['email'])->first();

        // Cek apakah user ada DAN password cocok (String comparison)
        if (!$user || $fields['password'] !== $user->password) {
            return response([
                'message' => 'Email atau Password yang kamu masukkan salah'
            ], 401);
        }

        // Cek jika akun dinonaktifkan
        if (!$user->is_active) {
            return response([
                'message' => 'Akun kamu sedang dinonaktifkan'
            ], 403);
        }

        $token = $user->createToken('warungtoken')->plainTextToken;

        return response([
            'message' => 'Login Berhasil',
            'user' => $user,
            'token' => $token
        ], 200);
    }
    
    public function logout(Request $request) {
        // Menghapus token yang sedang digunakan saat ini
        $request->user()->currentAccessToken()->delete();

        return response([
            'message' => 'Berhasil Logout'
        ], 200);
    }
}