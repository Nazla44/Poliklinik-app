<x-layouts.app title="Dashboard Dokter">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold">
            Selamat Datang, {{ auth()->user()->nama }} 👋
        </h1>
        <p class="text-sm text-gray-400">
            {{ now()->translatedFormat('l, d F Y') }} — Berikut ringkasan aktivitas praktik Anda hari ini.
        </p>
    </div>

    {{-- STAT CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

        {{-- Total Jadwal --}}
        <div class="bg-white rounded-2xl shadow-sm p-5 relative overflow-hidden hover:shadow-md transition">
            <div class="flex justify-between items-center mb-3">
                <div class="bg-blue-100 text-blue-600 p-3 rounded-xl">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <a href="{{ route('jadwal-periksa.index') }}" class="text-sm text-blue-500 hover:underline">Lihat</a>
            </div>
            <h2 class="text-2xl font-bold">{{ $totalJadwal }}</h2>
            <p class="text-sm text-gray-400">Total Jadwal</p>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-blue-500"></div>
        </div>

        {{-- Pasien Menunggu --}}
        <div class="bg-white rounded-2xl shadow-sm p-5 relative overflow-hidden hover:shadow-md transition">
            <div class="flex justify-between items-center mb-3">
                <div class="bg-yellow-100 text-yellow-600 p-3 rounded-xl">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('periksa-pasien.index') }}" class="text-sm text-yellow-500 hover:underline">Lihat</a>
            </div>
            <h2 class="text-2xl font-bold">{{ $pasienMenunggu }}</h2>
            <p class="text-sm text-gray-400">Pasien Menunggu</p>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-yellow-500"></div>
        </div>

        {{-- Total Riwayat --}}
        <div class="bg-white rounded-2xl shadow-sm p-5 relative overflow-hidden hover:shadow-md transition">
            <div class="flex justify-between items-center mb-3">
                <div class="bg-pink-100 text-pink-600 p-3 rounded-xl">
                    <i class="fas fa-file-medical"></i>
                </div>
                <a href="{{ route('riwayat-pasien.index') }}" class="text-sm text-pink-500 hover:underline">Lihat</a>
            </div>
            <h2 class="text-2xl font-bold">{{ $totalRiwayat }}</h2>
            <p class="text-sm text-gray-400">Total Riwayat</p>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-pink-500"></div>
        </div>

    </div>

    {{-- CONTENT --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- TABEL JADWAL --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm p-5">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold">Jadwal Periksa</h3>
                <a href="{{ route('jadwal-periksa.index') }}" class="text-sm text-blue-500 hover:underline">
                    Lihat Semua →
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr class="text-xs uppercase text-gray-400">
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwals as $jadwal)
                            <tr>
                                <td class="font-medium">{{ $jadwal->hari }}</td>
                                <td>{{ $jadwal->jam_mulai }}</td>
                                <td>{{ $jadwal->jam_selesai }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-gray-400 py-8">
                                    <i class="fas fa-inbox text-2xl mb-2 block"></i>
                                    Belum ada jadwal periksa
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
                <a href="{{ route('jadwal-periksa.create') }}"
                    class="flex items-center gap-3 p-3 rounded-xl bg-blue-50 hover:bg-blue-100 transition">
                    <i class="fas fa-plus text-blue-500"></i>
                    <div>
                        <p class="font-semibold text-sm">Tambah Jadwal</p>
                        <p class="text-xs text-gray-400">Tambahkan jadwal periksa baru</p>
                    </div>
                </a>
                <a href="{{ route('periksa-pasien.index') }}"
                    class="flex items-center gap-3 p-3 rounded-xl bg-yellow-50 hover:bg-yellow-100 transition">
                    <i class="fas fa-stethoscope text-yellow-500"></i>
                    <div>
                        <p class="font-semibold text-sm">Periksa Pasien</p>
                        <p class="text-xs text-gray-400">Lihat daftar pasien menunggu</p>
                    </div>
                </a>
                <a href="{{ route('riwayat-pasien.index') }}"
                    class="flex items-center gap-3 p-3 rounded-xl bg-pink-50 hover:bg-pink-100 transition">
                    <i class="fas fa-file-medical text-pink-500"></i>
                    <div>
                        <p class="font-semibold text-sm">Riwayat Pasien</p>
                        <p class="text-xs text-gray-400">Lihat riwayat pemeriksaan</p>
                    </div>
                </a>
            </div>
        </div>

    </div>

</x-layouts.app>