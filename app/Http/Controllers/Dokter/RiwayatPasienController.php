<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Periksa;
use Illuminate\Support\Facades\Auth;

class RiwayatPasienController extends Controller
{
    public function index()
    {
        $riwayats = Periksa::whereHas('daftarPoli.jadwalPeriksa', function ($q) {
            $q->where('id_dokter', Auth::id());
        })
            ->with(['daftarPoli.pasien', 'daftarPoli.jadwalPeriksa'])
            ->latest()
            ->get();

        return view('dokter.riwayat-pasien.index', compact('riwayats'));
    }
}