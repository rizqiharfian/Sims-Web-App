<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])-> name('home')->middleware('auth');

Route::get('register',[RegisterController::class, 'index'])->name('register');
Route::post('register',[RegisterController::class, 'store'])->name('register.store');
Route::get('login',[LoginController::class, 'index'])->name('login');
Route::post('login',[LoginController::class, 'proses'])->name('login.proses');
Route::post('logout',[LoginController::class, 'keluar'])->name('login.keluar');


Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

Route::get('users', [UsersController::class, 'index'])->name('users'); // Menampilkan daftar user
Route::get('users/create', [UsersController::class, 'create'])->name('users.create'); // Halaman tambah user
Route::post('users', [UsersController::class, 'store'])->name('users.store'); // Simpan user baru
Route::delete('users/{id}', [UsersController::class, 'destroy'])->name('users.destroy'); // Hapus user
Route::get('users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit'); // Halaman edit user
Route::put('users/{id}/update', [UsersController::class, 'update'])->name('users.update'); // Proses update user

Route::get('produks', [ProdukController::class, 'index'])->name('produk'); // Menampilkan daftar user
Route::get('produks/create', [ProdukController::class, 'create'])->name('produk.create'); // Halaman tambah user
Route::get('produk/export', [ProdukController::class, 'export'])->name('produk.export');
Route::post('produks/store', [ProdukController::class, 'store'])->name('produk.store'); // Simpan user baru
Route::delete('produks/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy'); // Hapus user
Route::get('produks/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit'); // Halaman edit user
Route::post('produks/{id}/update', [ProdukController::class, 'update'])->name('produk.update'); // Proses update user

// Route::get('users', function(){
//     return view('users.index');
// })->name('users')->middleware('auth');