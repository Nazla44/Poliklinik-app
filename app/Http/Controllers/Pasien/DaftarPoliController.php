<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarPoliController extends Controller
{
    public function index()
    {
        $riwayat = DaftarPoli::where('id_pasien', Auth::id())
            ->with(['jadwalPeriksa.dokter.poli'])
            ->latest()
            ->get();

        $polis = Poli::all();

        return view('pasien.daftar-poli.index', compact('riwayat', 'polis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_poli' => 'required|exists:poli,id',
            'id_jadwal' => 'required|exists:jadwal_periksa,id',
            'keluhan' => 'required|string|max:500',
        ]);

        // Generate no antrian otomatis
        $lastAntrian = DaftarPoli::where('id_jadwal', $request->id_jadwal)
            ->whereDate('created_at', today())
            ->count();
        $noAntrian = $lastAntrian + 1;

        DaftarPoli::create([
            'id_pasien' => Auth::id(),
            'id_jadwal' => $request->id_jadwal,
            'keluhan' => $request->keluhan,
            'no_antrian' => $noAntrian,
        ]);

        return redirect()->route('daftar-poli.index')
            ->with('success', 'Berhasil Mendaftar ke Poli!');
    }

    public function getJadwal($id_poli)
    {
        $jadwals = JadwalPeriksa::whereHas('dokter', fn($q) => $q->where('id_poli', $id_poli))
            ->with('dokter')
            ->get()
            ->map(fn($j) => [
                'id' => $j->id,
                'label' => "{$j->hari} | {$j->jam_mulai} - {$j->jam_selesai} | Dr. {$j->dokter->nama}",
            ]);

        return response()->json($jadwals);
    }
}