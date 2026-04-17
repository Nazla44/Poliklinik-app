<x-layouts.app title="Form Periksa Pasien">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('periksa-pasien.index') }}"
            class="flex items-center justify-center w-9 h-9 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 transition">
            <i class="fas fa-arrow-left text-sm"></i>
        </a>
        <h2 class="text-2xl font-bold text-slate-800">Form Periksa Pasien</h2>
    </div>

    {{-- Info Pasien --}}
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200 mb-6">
        <div class="card-body p-6">
            <h3 class="font-semibold text-slate-700 mb-4">Info Pasien</h3>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-slate-400">Nama Pasien</p>
                    <p class="font-semibold">{{ $daftarPoli->pasien->nama ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-slate-400">No Antrian</p>
                    <p class="font-semibold">{{ $daftarPoli->no_antrian }}</p>
                </div>
                <div>
                    <p class="text-slate-400">Keluhan</p>
                    <p class="font-semibold">{{ $daftarPoli->keluhan }}</p>
                </div>
                <div>
                    <p class="text-slate-400">Jadwal</p>
                    <p class="font-semibold">
                        {{ $daftarPoli->jadwalPeriksa->hari ?? '-' }},
                        {{ $daftarPoli->jadwalPeriksa->jam_mulai ?? '-' }} -
                        {{ $daftarPoli->jadwalPeriksa->jam_selesai ?? '-' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Form Periksa --}}
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200">
        <div class="card-body p-8">
            <form action="{{ route('periksa-pasien.store', $daftarPoli->id) }}" method="POST">
                @csrf

                {{-- Catatan --}}
                <div class="form-control mb-6">
                    <label class="label">
                        <span class="label-text font-semibold text-slate-700 text-sm">
                            Catatan <span class="text-red-500">*</span>
                        </span>
                    </label>
                    <textarea name="catatan" rows="4" placeholder="Masukkan catatan pemeriksaan..." class="textarea textarea-bordered border-2 rounded-lg p-2 w-full
                               @error('catatan') textarea-error @enderror" required>{{ old('catatan') }}</textarea>
                    @error('catatan')
                        <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Obat --}}
                <div class="form-control mb-6">
                    <label class="label">
                        <span class="label-text font-semibold text-slate-700 text-sm">Obat</span>
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($obats as $obat)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="obat[]" value="{{ $obat->id }}"
                                    class="checkbox checkbox-primary checkbox-sm">
                                <span class="text-sm">{{ $obat->nama_obat }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Biaya --}}
                <div class="form-control mb-8">
                    <label class="label">
                        <span class="label-text font-semibold text-slate-700 text-sm">
                            Biaya Periksa <span class="text-red-500">*</span>
                        </span>
                    </label>
                    <input type="number" name="biaya_periksa" value="{{ old('biaya_periksa') }}"
                        placeholder="Masukkan biaya periksa..." class="input input-bordered border-2 rounded-lg p-2 w-full
                               @error('biaya_periksa') input-error @enderror" required>
                    @error('biaya_periksa')
                        <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-primary hover:bg-primary/90
                               text-white rounded-lg font-semibold text-sm transition">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('periksa-pasien.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-slate-100 hover:bg-slate-200
                               text-slate-600 rounded-xl font-semibold text-sm transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

</x-layouts.app>