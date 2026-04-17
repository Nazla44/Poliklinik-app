<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\Periksa;
use App\Models\Obat;
use App\Models\DetailPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriksaPasienController extends Controller
{
    public function index()
    {
        $pasiens = DaftarPoli::whereHas('jadwalPeriksa', function ($q) {
            $q->where('id_dokter', Auth::id());
        })
            ->whereDoesntHave('periksas')
            ->with(['pasien', 'jadwalPeriksa'])
            ->get();

        return view('dokter.periksa-pasien.index', compact('pasiens'));
    }

    public function show(DaftarPoli $daftarPoli)
    {
        $obats = Obat::all();
        return view('dokter.periksa-pasien.show', compact('daftarPoli', 'obats'));
    }

    public function store(Request $request, DaftarPoli $daftarPoli)
    {
        $request->validate([
            'catatan' => 'required|string',
            'biaya_periksa' => 'required|numeric',
            'obat' => 'nullable|array',
        ]);

        $periksa = Periksa::create([
            'id_daftar_poli' => $daftarPoli->id,
            'tgl_periksa' => now(),
            'catatan' => $request->catatan,
            'biaya_periksa' => $request->biaya_periksa,
        ]);

        if ($request->obat) {
            foreach ($request->obat as $id_obat) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $id_obat,
                ]);
            }
        }

        return redirect()->route('periksa-pasien.index')
            ->with('success', 'Pemeriksaan berhasil disimpan.');
    }
}