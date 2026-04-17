<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PoliController;
use App\Http\Controllers\Admin\DokterController;
use App\Http\Controllers\Admin\PasienController;
use App\Http\Controllers\Admin\ObatController;
use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\Dokter\PeriksaPasienController;
use App\Http\Controllers\Dokter\RiwayatPasienController;
use App\Http\Controllers\Pasien\DaftarPoliController;
use Illuminate\Support\Facades\Route;
use App\Models\Poli;
use App\Models\User;
use App\Models\Obat;
use App\Models\JadwalPeriksa;
use App\Models\DaftarPoli;
use App\Models\Periksa;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/* ------------- Admin Routes ------------- */
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        \Carbon\Carbon::setLocale('id');

        return view('admin.dashboard', [
            'totalPoli' => Poli::count(),
            'totalDokter' => User::where('role', 'dokter')->count(),
            'totalPasien' => User::where('role', 'pasien')->count(),
            'totalObat' => Obat::count(),
            'polis' => Poli::withCount(['dokters'])->latest()->limit(5)->get()
        ]);
    })->name('admin.dashboard');

    Route::resource('polis', PoliController::class);
    Route::resource('dokter', DokterController::class);
    Route::resource('pasien', PasienController::class);
    Route::resource('obat', ObatController::class);
});

/* ------------- Dokter Routes ------------- */
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
    Route::get('/dashboard', function () {
        $dokter = auth()->user();

        $totalJadwal = JadwalPeriksa::where('id_dokter', $dokter->id)->count();

        $pasienMenunggu = DaftarPoli::whereHas('jadwalPeriksa', fn($q) => $q->where('id_dokter', $dokter->id))
            ->whereDoesntHave('periksas')
            ->count();

        $totalRiwayat = Periksa::whereHas('daftarPoli.jadwalPeriksa', fn($q) => $q->where('id_dokter', $dokter->id))
            ->count();

        $jadwals = JadwalPeriksa::where('id_dokter', $dokter->id)
            ->latest()
            ->limit(5)
            ->get();

        return view('dokter.dashboard', compact(
            'totalJadwal',
            'pasienMenunggu',
            'totalRiwayat',
            'jadwals'
        ));
    })->name('dokter.dashboard');

    Route::resource('jadwal-periksa', JadwalPeriksaController::class);
    Route::resource('periksa-pasien', PeriksaPasienController::class)
        ->only(['index', 'show', 'store']);
    Route::get('riwayat-pasien', [RiwayatPasienController::class, 'index'])
        ->name('riwayat-pasien.index');
});

/* ------------- Pasien Routes ------------- */
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    Route::get('/dashboard', function () {
        $pasien = auth()->user();
        $totalDaftar = DaftarPoli::where('id_pasien', $pasien->id)->count();
        $riwayatPeriksa = Periksa::whereHas('daftarPoli', fn($q) => $q->where('id_pasien', $pasien->id))
            ->count();

        return view('pasien.dashboard', compact('totalDaftar', 'riwayatPeriksa'));
    })->name('pasien.dashboard');

    Route::resource('daftar-poli', DaftarPoliController::class)
        ->only(['index', 'store']);
    Route::get('get-jadwal/{id_poli}', [DaftarPoliController::class, 'getJadwal'])
        ->name('get-jadwal');
});