<x-layouts.app title="Daftar Poli">

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Daftar Poli</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4 rounded-xl shadow-sm">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- FORM PENDAFTARAN --}}
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200 mb-6">
        <div class="card-body p-8">

            <h3 class="text-lg font-bold text-center mb-6">
                📋 Pendaftaran Poli
            </h3>

            <form action="{{ route('daftar-poli.store') }}" method="POST">
                @csrf

                {{-- No Rekam Medis --}}
                <div class="form-control mb-5">
                    <label class="label">
                        <span class="label-text font-semibold text-slate-700 text-sm">
                            Nomor Rekam Medis
                        </span>
                    </label>
                    <input type="text" value="{{ auth()->user()->no_rm }}"
                        class="input input-bordered border-2 rounded-lg p-2 w-full bg-slate-50" readonly disabled>
                </div>

                {{-- Pilih Poli --}}
                <div class="form-control mb-5">
                    <label class="label">
                        <span class="label-text font-semibold text-slate-700 text-sm">
                            Pilih Poli <span class="text-red-500">*</span>
                        </span>
                    </label>
                    <select name="id_poli" id="id_poli" class="select select-bordered border-2 rounded-lg p-2 w-full
                               @error('id_poli') select-error @enderror" required>
                        <option value="">-- Pilih Poli --</option>
                        @foreach($polis as $poli)
                            <option value="{{ $poli->id }}" {{ old('id_poli') == $poli->id ? 'selected' : '' }}>
                                {{ $poli->nama_poli }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_poli')
                        <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Pilih Jadwal --}}
                <div class="form-control mb-5">
                    <label class="label">
                        <span class="label-text font-semibold text-slate-700 text-sm">
                            Pilih Jadwal Periksa <span class="text-red-500">*</span>
                        </span>
                    </label>
                    <select name="id_jadwal" id="id_jadwal" class="select select-bordered border-2 rounded-lg p-2 w-full
                               @error('id_jadwal') select-error @enderror" required>
                        <option value="">-- Pilih Jadwal --</option>
                    </select>
                    @error('id_jadwal')
                        <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Keluhan --}}
                <div class="form-control mb-8">
                    <label class="label">
                        <span class="label-text font-semibold text-slate-700 text-sm">
                            Keluhan <span class="text-red-500">*</span>
                        </span>
                    </label>
                    <textarea name="keluhan" rows="4" placeholder="Tulis keluhan anda..." class="textarea textarea-bordered border-2 rounded-lg p-2 w-full
                               @error('keluhan') textarea-error @enderror" required>{{ old('keluhan') }}</textarea>
                    @error('keluhan')
                        <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center gap-2 px-8 py-2.5 bg-[#2d4499] hover:bg-[#1e2d6b]
                               text-white rounded-lg font-semibold text-sm transition">
                        Daftar Poli
                    </button>
                </div>

            </form>
        </div>
    </div>

</x-layouts.app>

<script>
    function loadJadwal(idPoli) {
        const jadwalSelect = document.getElementById('id_jadwal');
        jadwalSelect.innerHTML = '<option value="">-- Pilih Jadwal --</option>';

        if (!idPoli) return;

        fetch('{{ url("pasien/get-jadwal") }}/' + idPoli)
            .then(res => res.json())
            .then(data => {
                if (data.length === 0) {
                    jadwalSelect.innerHTML += '<option disabled>Belum ada jadwal tersedia</option>';
                    return;
                }
                data.forEach(jadwal => {
                    jadwalSelect.innerHTML += `<option value="${jadwal.id}">${jadwal.label}</option>`;
                });
            })
            .catch(err => console.error('Error:', err));
    }

    const poliSelect = document.getElementById('id_poli');

    if (poliSelect.value) {
        loadJadwal(poliSelect.value);
    }

    poliSelect.addEventListener('change', function () {
        loadJadwal(this.value);
    });
</script>