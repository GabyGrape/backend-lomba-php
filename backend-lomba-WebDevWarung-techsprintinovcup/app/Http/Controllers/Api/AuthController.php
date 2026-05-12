<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role; // Pastikan model Role sudah dibuat dan diimport

class AuthController extends Controller
{
    // public function register(Request $request) {
    //     $fields = $request->validate([
    //         'name' => 'required|string',
    //         // Pastikan menunjuk ke tabel users_
    //         'email' => 'required|string|email|unique:users_,email',
    //         'password' => 'required|string|min:6',
    //         'role' => 'required|in:pedagang,konsumen,user,admin,developer' // Validasi sesuai Enum
    //     ]);

    //     $user = User::create([
    //         'name' => $fields['name'],
    //         'email' => $fields['email'],
    //         'password' => $fields['password'], // Masih Plain Text sesuai diskusi
    //         'role' => $fields['role'],
    //         'is_active' => true // Set default aktif saat daftar
    //     ]);

    //     // Membuat Token menggunakan Sanctum
    //     $token = $user->createToken('warungtoken')->plainTextToken;

    //     return response([
    //         'message' => 'Registrasi Berhasil',
    //         'user' => $user,
    //         'token' => $token
    //     ], 201);
    // }
//     public function register(Request $request) {
//     $fields = $request->validate([
//         'name' => 'required|string',
//         'email' => 'required|string|email|unique:users_,email',
//         'password' => 'required|string|min:6',
//         // 'role' => 'required|in:pedagang,konsumen,user,admin,developer',
//         'role_name' => 'required|in:pedagang,konsumen', // Gunakan role_name untuk mencari ID
//         // Tambahkan validasi opsional
//         'nama_warung' => 'nullable|string',
//         'alamat_warung' => 'nullable|string'
//     ]);
// // Cari ID role di tabel roles
//     $role = \App\Models\Role::where('name', $fields['role_name'])->first();
public function register(Request $request) {
    $fields = $request->validate([
        'name' => 'required|string',
        'email' => 'required|string|email|unique:users_,email',
        'password' => 'required|string|min:6',
        'role' => 'required|in:pedagang,konsumen', // FE kirim key "role"
        'nama_warung' => 'nullable|string',
        'alamat_warung' => 'nullable|string'
    ]);

    // Cari ID role berdasarkan input 'role'
    $role = \App\Models\Role::where('name', $fields['role'])->first();
    if (!$role) {
        return response([
            'message' => 'Role yang dipilih tidak valid'
        ], 400);
    }

    $user = User::create([
        'name' => $fields['name'],
        'email' => $fields['email'],
        'password' => $fields['password'], 
        // 'role' => $fields['role'],
        'role_id' => $role->id, // Simpan ID-nya, bukan string namanya
        'nama_warung' => $fields['nama_warung'] ?? null, // Opsional
        'alamat_warung' => $fields['alamat_warung'] ?? null, // Opsional
        'is_active' => true 
    ]);

    $token = $user->createToken('warungtoken')->plainTextToken;

    // return response([
    //     'message' => 'Registrasi Berhasil',
    //     'user' => $user->load('role'),
    //     'token' => $token
    // ], 201);
    return response([
    'message' => 'Registrasi Berhasil',
    'user' => $user, // Accessor 'role' akan otomatis muncul sebagai string
    'token' => $token
], 201);
}

    // public function login(Request $request) {
    //     $fields = $request->validate([
    //         'email' => 'required|string|email',
    //         'password' => 'required|string'
    //     ]);

    //     // Cari user di tabel users_
    //     $user = User::where('email', $fields['email'])->first();

    //     // Cek apakah user ada DAN password cocok (String comparison)
    //     if (!$user || $fields['password'] !== $user->password) {
    //         return response([
    //             'message' => 'Email atau Password yang kamu masukkan salah'
    //         ], 401);
    //     }

    //     // Cek jika akun dinonaktifkan
    //     if (!$user->is_active) {
    //         return response([
    //             'message' => 'Akun kamu sedang dinonaktifkan'
    //         ], 403);
    //     }

    //     $token = $user->createToken('warungtoken')->plainTextToken;

    //     return response([
    //         'message' => 'Login Berhasil',
    //         'user' => $user,
    //         'token' => $token
    //     ], 200);
    // }
    // public function login(Request $request) {
    // $fields = $request->validate([
    //     'email' => 'required|string|email',
    //     'password' => 'required|string'
    // ]);

    // // Tambahkan load('role') agar konsisten dengan Register
    // $user = User::with('role')->where('email', $fields['email'])->first();

    // if (!$user || $fields['password'] !== $user->password) {
    //     return response([
    //         'message' => 'Email atau Password yang kamu masukkan salah'
    //     ], 401);
    // }
    public function login(Request $request) {
    $fields = $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string'
    ]);

    // HAPUS .with('role') di sini
    $user = User::where('email', $fields['email'])->first();

    if (!$user || $fields['password'] !== $user->password) {
        return response([
            'message' => 'Email atau Password yang kamu masukkan salah'
        ], 401);
    }

    if (!$user->is_active) {
        return response(['message' => 'Akun kamu sedang dinonaktifkan'], 403);
    }

    $token = $user->createToken('warungtoken')->plainTextToken;

    // return response([
    //     'message' => 'Login Berhasil',
    //     'user' => $user, // Sekarang sudah ada objek role-nya
    //     'token' => $token
    // ], 200);
//     return response([
//     'message' => 'Login Berhasil',
//     'user' => $user, // Otomatis menyertakan role: "pedagang"
//     'token' => $token
// ], 200);
// }
return response([
        'message' => 'Login Berhasil',
        'user' => $user, // Ini akan otomatis menggunakan Accessor String
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

    public function updateProfile(Request $request) {
    $user = $request->user(); // Mengambil user yang sedang login dari token

    $fields = $request->validate([
        'name' => 'string',
        'nama_warung' => 'string|nullable',
        'alamat_warung' => 'string|nullable',
        // Email biasanya tidak diubah sembarangan, tapi jika perlu:
        'email' => 'string|email|unique:users_,email,' . $user->id,
    ]);

    $user->update($fields);

    return response([
        'message' => 'Profil berhasil diperbarui',
        'user' => $user
    ], 200);
}
    // Bagian 1: Cek apakah email terdaftar
public function forgotPassword(Request $request) {
    $fields = $request->validate([
        'email' => 'required|string|email'
    ]);

    // Cari user di tabel users_
    $user = User::where('email', $fields['email'])->first();

    if (!$user) {
        return response([
            'message' => 'Your email isnt registered in our system.'
        ], 404);
    }

    return response([
        'message' => 'Email ditemukan, silakan ganti password anda.',
        'email' => $user->email // Mengirim balik email untuk memudahkan frontend
    ], 200);
}

// Bagian 2: Eksekusi perubahan password
public function resetPassword(Request $request) {
    $fields = $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string|min:6|confirmed' 
        // 'confirmed' mengharuskan ada input password_confirmation
    ]);

    $user = User::where('email', $fields['email'])->first();

    if (!$user) {
        return response([
            'message' => 'User tidak ditemukan'
        ], 404);
    }

    // Update password (Plain Text)
    $user->password = $fields['password'];
    $user->save();

    return response([
        'message' => 'Password berhasil diperbarui, silakan login.'
    ], 200);
}

// --- USER MANAGEMENT FEATURES (NEW) ---

    /**
     * Ambil semua data user
     */
public function getAllUsers(Request $request) {
    // Cek apakah user yang login memiliki role admin atau developer
    // Sesuai dengan enum yang kamu buat sebelumnya
    if ($request->user()->role->name !== 'admin' && $request->user()->role->name !== 'developer') {
        return response([
            'message' => 'Forbidden: Anda tidak memiliki akses ke halaman ini.'
        ], 403); // 403 adalah kode error Forbidden
    }

    $users = User::all();
    return response([
        'message' => 'Berhasil mengambil semua data user',
        'data' => $users
    ], 200);
}

    /**
     * Ambil user spesifik berdasarkan ID
     */
    // public function getUserById($id) {
    //     $user = User::find($id);

    //     if (!$user) {
    //         return response(['message' => 'User dengan ID tersebut tidak ditemukan'], 404);
    //     }

    //     return response([
    //         'message' => 'User ditemukan',
    //         'data' => $user
    //     ], 200);
    // }
    public function getUserById($id) {
    $user = User::find($id);

    if (!$user) {
        return response(['message' => 'User dengan ID tersebut tidak ditemukan'], 404);
    }

    // TAMBAHKAN LOGIKA INI:
    // Jika user punya qris_path, kita buatkan URL lengkapnya
    if ($user->qris_path) {
        $user->qris_url = url('storage/' . $user->qris_path);
    } else {
        $user->qris_url = null;
    }

    return response([
        'message' => 'User ditemukan',
        'data' => $user
    ], 200);
}

    /**
     * Cari user berdasarkan Email (Query Parameter)
     * Contoh: /api/users/search?email=test@gmail.com
     */
    public function getUserByEmail(Request $request) {
        $request->validate(['email' => 'required|email']);
        
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response(['message' => 'User dengan email tersebut tidak ditemukan'], 404);
        }

        return response([
            'message' => 'User ditemukan',
            'data' => $user
        ], 200);
    }
    public function updateQris(Request $request)
{
    $request->validate([
        'qris_image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
    ]);

    $user = $request->user();

    // Proteksi Role
    if ($user->role !== 'pedagang') {
        return response(['message' => 'Hanya pedagang yang memiliki QRIS'], 403);
    }

    if ($request->hasFile('qris_image')) {
        // Hapus file lama jika ada (opsional agar storage tidak penuh)
        if ($user->qris_path && \Storage::disk('public')->exists($user->qris_path)) {
            \Storage::disk('public')->delete($user->qris_path);
        }

        // Simpan file baru ke folder public/qris
        $path = $request->file('qris_image')->store('qris', 'public');

        // Simpan path-nya ke database
        $user->update(['qris_path' => $path]);

        return response([
            'message' => 'QRIS berhasil diperbarui',
            'qris_url' => url('storage/' . $path) // URL untuk ditampilkan di FE
        ]);
    }
}
}