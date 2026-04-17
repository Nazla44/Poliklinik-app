<x-layouts.app title="Periksa Pasien">

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Periksa Pasien</h2>
    </div>

    <div class="card bg-base-100 shadow-md rounded-2xl">
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead class="bg-slate-100 text-slate-500 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Pasien</th>
                            <th class="px-6 py-4">Keluhan</th>
                            <th class="px-6 py-4">No Antrian</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pasiens as $daftar)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-semibold">{{ $daftar->pasien->nama ?? '-' }}</td>
                                <td class="px-6 py-4 text-slate-500">{{ $daftar->keluhan }}</td>
                                <td class="px-6 py-4">{{ $daftar->no_antrian }}</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('periksa-pasien.show', $daftar->id) }}"
                                        class="btn btn-sm bg-blue-500 hover:bg-blue-600 text-white border-none rounded-lg px-4">
                                        <i class="fas fa-stethoscope"></i> Periksa
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-14 text-slate-400">
                                    <i class="fas fa-inbox text-3xl mb-3 block"></i>
                                    Tidak ada data pasien periksa
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-layouts.app>