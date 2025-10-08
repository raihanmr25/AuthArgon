<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController; // CRUD user admin
use App\Http\Controllers\BarangPemakaianController;
use App\Http\Controllers\PDFGenController;

// Rute untuk register dan login tanpa middleware auth
Route::get('register', function () {
    return view('auth.register');
})->name('register');

Route::post('register', [AuthController::class, 'register']);

Route::get(
    '/login', function () {
    return view('auth.login');
})->name('login');

Route::post('login', [AuthController::class, 'store'])->name('login');

Route::get('/', function () {
    return view('landing');
})->name('landing');



// Rute yang sudah memerlukan autentikasi (auth)
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.home');
    Route::get('/login/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/item', [DashboardController::class, 'item'])->name('item');
    Route::get('/barang/create', [BarangPemakaianController::class, 'create'])->name('barang.create');
    Route::post('/barang/store', [BarangPemakaianController::class, 'store'])->name('barang.store');
    Route::get('/games', [GamesController::class, 'index'])->name('games.index');

    // 🕹️ Game sederhana
    Route::get('/games', function () {
        return view('ames');
    })->name('games');

    // Rute untuk logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // CRUD admin user
    Route::resource('admin', AdminController::class)->except(['create', 'show']);

    Route::delete('/barang/{id}', [BarangPemakaianController::class, 'destroy'])->name('barang.destroy');
    Route::put('/barang/{id}', [BarangPemakaianController::class, 'update'])->name('barang.update');
    Route::get('/barang/{id}/edit', [BarangPemakaianController::class, 'edit'])->name('barang.edit');

    // Generate PDF
    Route::get('/generate-pdf', [PDFGenController::class, 'generatePDF'])->name('data.cetak');

});

// // Rute untuk halaman utama (redirect ke dashboard)
// Route::get('/', fn () => redirect()->route('dashboard'));
