<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ isset($jadwal) ? 'Edit Jadwal' : 'Buat Jadwal Baru' }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-8 px-4 mt-4 bg-white shadow-md rounded-lg">

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
        @endif

        <form action="{{ isset($jadwal) ? route('jadwal.update', $jadwal->jadwal_id) : route('jadwal.store') }}" 
              method="POST" class="space-y-6">
            @csrf
            @if(isset($jadwal))
                @method('PUT')
            @endif

            <!-- PIC / Pemohon -->
            <div x-data="pendaftaranSearch()" class="relative">
                <label class="font-semibold mb-1 block">PIC / Pemohon</label>
                <input type="text" 
                       x-model="query"
                       @input="filter()"
                       placeholder="Cari nama atau lokasi..." 
                       class="border border-gray-300 px-3 py-2 w-full rounded focus:outline-none focus:ring-2 focus:ring-blue-400" 
                       required>

                <ul x-show="filtered.length > 0" 
                    class="absolute z-10 bg-white border border-gray-300 mt-1 w-full rounded shadow max-h-48 overflow-auto">
                    <template x-for="item in filtered" :key="item.pendaftaran_id">
                        <li @click="select(item)" 
                            class="px-3 py-2 hover:bg-blue-100 cursor-pointer">
                            <span x-text="item.nama_lengkap"></span> (<span x-text="item.lokasi_layanan"></span>)
                        </li>
                    </template>
                </ul>

                <input type="hidden" name="pendaftaran_id" x-model="selectedId">
                @error('pendaftaran_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Tanggal dan Lokasi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="font-semibold mb-1 block">Tanggal Pelayanan</label>
                    <input type="date" name="tanggal_pelayanan"
                           value="{{ old('tanggal_pelayanan', isset($jadwal) ? $jadwal->tanggal_pelayanan : '') }}"
                           class="border border-gray-300 px-3 py-2 w-full rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                           required>
                    @error('tanggal_pelayanan') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="font-semibold mb-1 block">Lokasi Pelayanan</label>
                    <input type="text" name="lokasi_pelayanan"
                           value="{{ old('lokasi_pelayanan', isset($jadwal) ? $jadwal->lokasi_pelayanan : '') }}"
                           class="border border-gray-300 px-3 py-2 w-full rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                           placeholder="Masukkan lokasi..." required>
                    @error('lokasi_pelayanan') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Waktu -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="font-semibold mb-1 block">Waktu Mulai</label>
                    <input type="time" name="waktu_mulai"
                           value="{{ old('waktu_mulai', isset($jadwal) ? $jadwal->waktu_mulai : '') }}"
                           class="border border-gray-300 px-3 py-2 w-full rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                           required>
                    @error('waktu_mulai') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="font-semibold mb-1 block">Waktu Selesai</label>
                    <input type="time" name="waktu_selesai"
                           value="{{ old('waktu_selesai', isset($jadwal) ? $jadwal->waktu_selesai : '') }}"
                           class="border border-gray-300 px-3 py-2 w-full rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                           required>
                    @error('waktu_selesai') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Tombol aksi -->
            <div class="flex items-center gap-3">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded shadow transition duration-200">
                    {{ isset($jadwal) ? 'Simpan Perubahan' : 'Simpan Jadwal' }}
                </button>
                <a href="{{ route('jadwal.index') }}" 
                   class="text-gray-600 underline hover:text-gray-800 transition duration-200">Batal</a>
            </div>
        </form>
    </div>

    <script>
    function pendaftaranSearch() {
        return {
            query: @json(isset($jadwal) ? $jadwal->pendaftaran->user->nama_lengkap.' ('.$jadwal->pendaftaran->lokasi_layanan.')' : ''),
            selectedId: @json(isset($jadwal) ? $jadwal->pendaftaran_id : ''),
            all: @json($pendaftarans->map(fn($p) => [
                'pendaftaran_id' => $p->pendaftaran_id,
                'nama_lengkap' => $p->user->nama_lengkap,
                'lokasi_layanan' => $p->lokasi_layanan
            ])),
            filtered: [],
            filter() {
                const q = this.query.toLowerCase();
                this.filtered = this.all.filter(p => 
                    p.nama_lengkap.toLowerCase().includes(q) || 
                    p.lokasi_layanan.toLowerCase().includes(q)
                );
            },
            select(item) {
                this.query = `${item.nama_lengkap} (${item.lokasi_layanan})`;
                this.selectedId = item.pendaftaran_id;
                this.filtered = [];
            }
        }
    }
    </script>
</x-app-layout>
