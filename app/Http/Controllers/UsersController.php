<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 5;
        $users = User::paginate($perPage); // Paginate data untuk tampilan

        // Hitung total halaman
        $totalPages = $users->lastPage();
        $currentPage = $users->currentPage();

        return view('users.index', compact('users','totalPages', 'currentPage'));
    }


    public function create()
    {
        return view('users.create'); // Menampilkan form tambah user
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
            'password' => 'required|min:6',
        ]);

        // Simpan user ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users')->with('message', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Cari user berdasarkan ID
        return view('users.edit', compact('user')); // Kirim data ke view
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id); // Cari user berdasarkan ID

    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id, // Menghindari duplikasi email
        'role' => 'required|in:Admin,Pemilik,User', // Validasi hanya menerima nilai 'Admin' atau 'User'
    ]);

    // Update data user
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'password' => $request->password ? Hash::make($request->password) : $user->password, // Jika password kosong, tidak diubah
    ]);

    // Redirect kembali ke halaman users dengan pesan sukses
    return redirect()->route('users')->with('message', 'User berhasil diperbarui.');
}

    public function destroy($id)
    {
        $user = User::findOrFail($id); // Cari user berdasarkan ID
        $user->delete(); // Hapus data user
        return redirect()->route('users')->with('message', 'User berhasil dihapus.');
    }
}
