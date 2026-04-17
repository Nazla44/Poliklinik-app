<x-layouts.app title="Dashboard Pasien">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold">
            Selamat Datang, {{ auth()->user()->nama }} 👋
        </h1>
        <p class="text-sm text-gray-400">
            {{ now()->translatedFormat('l, d F Y') }}
        </p>
    </div>

    {{-- STAT CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

        <div class="bg-white rounded-2xl shadow-sm p-5 relative overflow-hidden hover:shadow-md transition">
            <div class="flex justify-between items-center mb-3">
                <div class="bg-blue-100 text-blue-600 p-3 rounded-xl">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <a href="{{ route('daftar-poli.index') }}" class="text-sm text-blue-500 hover:underline">Lihat</a>
            </div>
            <h2 class="text-2xl font-bold">{{ $totalDaftar }}</h2>
            <p class="text-sm text-gray-400">Total Pendaftaran</p>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-blue-500"></div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-5 relative overflow-hidden hover:shadow-md transition">
            <div class="flex justify-between items-center mb-3">
                <div class="bg-green-100 text-green-600 p-3 rounded-xl">
                    <i class="fas fa-file-medical"></i>
                </div>
            </div>
            <h2 class="text-2xl font-bold">{{ $riwayatPeriksa }}</h2>
            <p class="text-sm text-gray-400">Riwayat Periksa</p>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-green-500"></div>
        </div>

    </div>

    {{-- AKSES CEPAT --}}
    <div class="bg-white rounded-2xl shadow-sm p-5">
        <h3 class="font-semibold mb-4">Akses Cepat</h3>
        <div class="space-y-3">
            <a href="{{ route('daftar-poli.index') }}"
                class="flex items-center gap-3 p-3 rounded-xl bg-blue-50 hover:bg-blue-100 transition">
                <i class="fas fa-plus text-blue-500"></i>
                <div>
                    <p class="font-semibold text-sm">Daftar Poli</p>
                    <p class="text-xs text-gray-400">Daftarkan diri ke poli</p>
                </div>
            </a>
        </div>
    </div>

</x-layouts.app>