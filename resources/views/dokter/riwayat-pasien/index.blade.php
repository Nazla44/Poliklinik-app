<x-layouts.app title="Riwayat Pasien">

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Riwayat Pasien</h2>
    </div>

    <div class="card bg-base-100 shadow-md rounded-2xl">
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead class="bg-slate-100 text-slate-500 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4">No Antrian</th>
                            <th class="px-6 py-4">Nama Pasien</th>
                            <th class="px-6 py-4">Keluhan</th>
                            <th class="px-6 py-4">Tanggal Periksa</th>
                            <th class="px-6 py-4">Biaya</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayats as $riwayat)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">{{ $riwayat->daftarPoli->no_antrian ?? '-' }}</td>
                                <td class="px-6 py-4 font-semibold">{{ $riwayat->daftarPoli->pasien->nama ?? '-' }}</td>
                                <td class="px-6 py-4 text-slate-500">{{ $riwayat->daftarPoli->keluhan ?? '-' }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($riwayat->tgl_periksa)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">Rp {{ number_format($riwayat->biaya_periksa, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="#"
                                        class="btn btn-sm bg-blue-500 hover:bg-blue-600 text-white border-none rounded-lg px-4">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-14 text-slate-400">
                                    <i class="fas fa-inbox text-3xl mb-3 block"></i>
                                    Belum ada riwayat pemeriksaan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-layouts.app>