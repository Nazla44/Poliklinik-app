<x-layouts.app title="Admin Dashboard">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold">
            Selamat Datang, {{ auth()->user()->nama }} 👋
        </h1>
        <p class="text-sm text-gray-400">
            {{ now()->translatedFormat('l, d F Y') }}
        </p>
    </div>

    {{-- CARD STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

        {{-- POLI --}}
        <div class="bg-white rounded-2xl shadow-sm p-5 relative overflow-hidden hover:shadow-md transition">
            <div class="flex justify-between items-center mb-3">
                <div class="bg-blue-100 text-blue-600 p-3 rounded-xl">
                    <i class="fas fa-hospital"></i>
                </div>
            </div>
            <h2 class="text-2xl font-bold">{{ $totalPoli }}</h2>
            <p class="text-sm text-gray-400">Total Poli</p>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-blue-500"></div>
        </div>

        {{-- DOKTER --}}
        <div class="bg-white rounded-2xl shadow-sm p-5 relative overflow-hidden hover:shadow-md transition">
            <div class="flex justify-between items-center mb-3">
                <div class="bg-green-100 text-green-600 p-3 rounded-xl">
                    <i class="fas fa-user-doctor"></i>
                </div>
            </div>
            <h2 class="text-2xl font-bold">{{ $totalDokter }}</h2>
            <p class="text-sm text-gray-400">Total Dokter</p>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-green-500"></div>
        </div>

        {{-- PASIEN --}}
        <div class="bg-white rounded-2xl shadow-sm p-5 relative overflow-hidden hover:shadow-md transition">
            <div class="flex justify-between items-center mb-3">
                <div class="bg-yellow-100 text-yellow-600 p-3 rounded-xl">
                    <i class="fas fa-user"></i>
                </div>
            </div>
            <h2 class="text-2xl font-bold">{{ $totalPasien }}</h2>
            <p class="text-sm text-gray-400">Total Pasien</p>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-yellow-500"></div>
        </div>

        {{-- OBAT --}}
        <div class="bg-white rounded-2xl shadow-sm p-5 relative overflow-hidden hover:shadow-md transition">
            <div class="flex justify-between items-center mb-3">
                <div class="bg-pink-100 text-pink-600 p-3 rounded-xl">
                    <i class="fas fa-capsules"></i>
                </div>
            </div>
            <h2 class="text-2xl font-bold">{{ $totalObat }}</h2>
            <p class="text-sm text-gray-400">Total Obat</p>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-pink-500"></div>
        </div>

    </div>

    {{-- CONTENT --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- TABEL POLI --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm p-5">

            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold">Daftar Poli</h3>
                <a href="{{ route('polis.index') }}" class="text-sm text-blue-500 hover:underline font-medium">
                    Lihat Semua →
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr class="text-xs uppercase text-gray-400">
                            <th>Nama Poli</th>
                            <th>Keterangan</th>
                            <th>Dokter</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($polis as $poli)
                            <tr>
                                <td class="font-medium">{{ $poli->nama_poli }}</td>
                                <td class="text-gray-500 text-sm">{{ Str::limit($poli->keterangan, 60) }}</td>
                                <td>
                                    {{-- ganti tombol dengan ini --}}
                                    <span class="btn btn-sm bg-blue-500 text-white border-none rounded-lg px-3">
                                        {{ $poli->dokters_count }} Dokter
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-gray-400">
                                    Data belum tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

        {{-- AKSES CEPAT --}}
        <div class="bg-white rounded-2xl shadow-sm p-5">

            <h3 class="font-semibold mb-4">Akses Cepat</h3>

            <div class="space-y-3">

                <a href="{{ route('polis.create') }}"
                    class="flex items-center gap-3 p-3 rounded-xl bg-blue-50 hover:bg-blue-100 transition">
                    <i class="fas fa-plus text-blue-500"></i>
                    <div>
                        <p class="font-semibold text-sm">Tambah Poli</p>
                        <p class="text-xs text-gray-400">Daftarkan poli baru</p>
                    </div>
                </a>

                <a href="{{ route('dokter.create') }}"
                    class="flex items-center gap-3 p-3 rounded-xl bg-green-50 hover:bg-green-100 transition">
                    <i class="fas fa-user-doctor text-green-500"></i>
                    <div>
                        <p class="font-semibold text-sm">Tambah Dokter</p>
                        <p class="text-xs text-gray-400">Daftarkan dokter baru</p>
                    </div>
                </a>

                <a href="{{ route('pasien.create') }}"
                    class="flex items-center gap-3 p-3 rounded-xl bg-yellow-50 hover:bg-yellow-100 transition">
                    <i class="fas fa-user text-yellow-500"></i>
                    <div>
                        <p class="font-semibold text-sm">Tambah Pasien</p>
                        <p class="text-xs text-gray-400">Daftarkan pasien baru</p>
                    </div>
                </a>

                <a href="{{ route('obat.create') }}"
                    class="flex items-center gap-3 p-3 rounded-xl bg-pink-50 hover:bg-pink-100 transition">
                    <i class="fas fa-capsules text-pink-500"></i>
                    <div>
                        <p class="font-semibold text-sm">Tambah Obat</p>
                        <p class="text-xs text-gray-400">Tambah data obat</p>
                    </div>
                </a>

            </div>

        </div>

    </div>

</x-layouts.app>