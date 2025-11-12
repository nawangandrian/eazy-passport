<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Surat Pemberitahuan') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4">

        {{-- Alert Sukses --}}
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded shadow flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Alert Error --}}
        @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded shadow flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white shadow-lg rounded-xl border border-gray-200 p-6">

            {{-- Filter Form + Tombol Buat Surat Baru (Responsive) --}}
<div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

    {{-- 🔍 Form Filter --}}
    <form method="GET" action="{{ route('surat.index') }}" 
          class="flex flex-col sm:flex-wrap sm:flex-row items-stretch sm:items-center gap-2 w-full sm:w-auto bg-gray-50 p-3 rounded-lg border border-gray-200">

        {{-- Input Pencarian --}}
        <input 
            type="text" 
            name="search" 
            placeholder="Cari nomor surat / PIC..."
            value="{{ $search ?? '' }}"
            class="border px-3 py-2 rounded w-full sm:w-52 focus:ring-2 focus:ring-blue-500 transition"
        >

        {{-- Tanggal Mulai --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-1 w-full sm:w-auto">
            <label for="tanggal_mulai" class="font-semibold text-sm sm:mr-1">Dari:</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" 
                   class="border px-2 py-2 rounded w-full sm:w-40 focus:ring-2 focus:ring-blue-500 transition" 
                   value="{{ $tanggalMulai ?? '' }}">
        </div>

        {{-- Tanggal Akhir --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-1 w-full sm:w-auto">
            <label for="tanggal_akhir" class="font-semibold text-sm sm:mr-1">Sampai:</label>
            <input type="date" name="tanggal_akhir" id="tanggal_akhir" 
                   class="border px-2 py-2 rounded w-full sm:w-40 focus:ring-2 focus:ring-blue-500 transition" 
                   value="{{ $tanggalAkhir ?? '' }}">
        </div>

        {{-- Tombol Filter --}}
        <div class="flex flex-wrap gap-2 w-full sm:w-auto mt-2 sm:mt-0">
            <button type="submit" 
                    class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 text-sm font-medium transition">
                Terapkan
            </button>

            {{-- Tombol Cetak PDF --}}
            <a href="{{ route('surat.exportPdf', request()->query()) }}" target="_blank"
                class="w-full sm:w-auto bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700 text-sm font-medium text-center transition">
                Cetak PDF
            </a>

            {{-- Tombol Reset --}}
            @if($search || $tanggalMulai || $tanggalAkhir)
                <a href="{{ route('surat.index') }}" 
                   class="w-full sm:w-auto text-gray-700 underline text-sm font-medium text-center">
                    Reset
                </a>
            @endif
        </div>
    </form>

    {{-- 📨 Tombol Buat Surat --}}
    @if($jadwal_disetujui->isNotEmpty() && Auth::user()->role !== 'KEPALA_KANTOR')
        <div x-data="{
            open: false,
            search: '',
            currentPage: 1,
            perPage: 5,
            get filteredJadwal() {
                return Array.from($el.querySelectorAll('.jadwal-item'))
                            .map((el, index) => ({ el, index }))
                            .filter(j => !this.search || j.el.dataset.pic.toLowerCase().includes(this.search.toLowerCase()));
            },
            get totalPages() {
                return Math.ceil(this.filteredJadwal.length / this.perPage);
            },
            get paginatedJadwal() {
                const start = (this.currentPage - 1) * this.perPage;
                const end = start + this.perPage;
                return this.filteredJadwal.slice(start, end);
            }
        }" class="w-full sm:w-auto flex justify-end">
            
            <button @click="open = true"
                    class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition transform hover:-translate-y-1">
                Buat Surat
            </button>

            {{-- Modal --}}
            <div x-show="open" x-cloak 
                 class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 px-4">
                <div @click.away="open = false" 
                     class="bg-white rounded-lg w-full max-w-lg p-6 shadow-lg overflow-y-auto max-h-[90vh]">
                    
                    <h2 class="text-lg font-semibold mb-4">Pilih Jadwal Disetujui</h2>

                    {{-- Search --}}
                    <input type="text" placeholder="Cari PIC..." x-model="search" @input="currentPage = 1"
                        class="border px-3 py-2 rounded w-full mb-4 focus:ring-2 focus:ring-blue-500">

                    {{-- Daftar Jadwal --}}
                    <div class="max-h-64 overflow-y-auto divide-y">
                        @foreach($jadwal_disetujui as $jadwal)
                            <div class="py-3 flex justify-between items-center jadwal-item"
                                data-pic="{{ strtolower(optional($jadwal->pendaftaran->user)->nama_lengkap ?? '') }}"
                                x-show="paginatedJadwal.map(j => j.index).includes({{ $loop->index }})">
                                <div>
                                    <p class="font-medium">{{ optional($jadwal->pendaftaran->user)->nama_lengkap ?? 'PIC' }}</p>
                                    <p class="text-gray-500 text-sm">
                                        {{ \Carbon\Carbon::parse($jadwal->tanggal_pelayanan)->format('d-m-Y') }}
                                    </p>
                                </div>
                                <a href="{{ route('surat.create', ['jadwal' => $jadwal->jadwal_id]) }}"
                                   class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm font-semibold">
                                    Buat Surat
                                </a>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="flex justify-between items-center mt-4">
                        <button @click="currentPage = Math.max(currentPage - 1, 1)"
                                :disabled="currentPage === 1"
                                class="px-3 py-1 bg-gray-200 rounded disabled:opacity-50">Prev</button>

                        <span x-text="`Halaman ${currentPage} dari ${totalPages}`" class="text-sm"></span>

                        <button @click="currentPage = Math.min(currentPage + 1, totalPages)"
                                :disabled="currentPage === totalPages"
                                class="px-3 py-1 bg-gray-200 rounded disabled:opacity-50">Next</button>
                    </div>

                    {{-- Close --}}
                    <div class="mt-4 text-right">
                        <button @click="open = false" 
                                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>


            {{-- Tabel Daftar Surat --}}
            <div class="overflow-x-auto rounded-lg border border-gray-100">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="bg-gray-50 uppercase text-xs font-medium text-gray-500 tracking-wider">
                        <tr>
                            <th class="px-4 py-2 rounded-tl-lg">#</th>
                            <th class="px-4 py-2">Nomor Surat</th>
                            <th class="px-4 py-2">Jadwal</th>
                            <th class="px-4 py-2">PIC</th>
                            <th class="px-4 py-2">Jumlah Pemohon</th>
                            <th class="px-4 py-2">Lokasi Pelayanan</th>
                            <th class="px-4 py-2">Petugas</th>
                            <th class="px-4 py-2">Tanggal Terbit</th>
                            <th class="px-4 py-2 rounded-tr-lg">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($surats as $i => $surat)
                            <tr class="border-b hover:bg-blue-50 transition">
                                <td class="px-4 py-2">{{ $surats->firstItem() + $i }}</td>
                                <td class="px-4 py-2 font-medium">{{ $surat->nomor_surat }}</td>
                                <td class="px-4 py-2">
                                    @if($surat->jadwal && $surat->jadwal->tanggal_pelayanan)
                                        {{ \Carbon\Carbon::parse($surat->jadwal->tanggal_pelayanan)->format('d-m-Y') }}
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">{{ $surat->penerima->nama_lengkap ?? '-' }}</td>

                                {{-- Jumlah Pemohon --}}
                                <td class="px-4 py-2 text-center">
                                    {{ $surat->jadwal ? $surat->jadwal->pendaftaran->count() : 0 }}
                                </td>

                                {{-- Lokasi Pelayanan --}}
                                <td class="px-4 py-2">
                                    {{ $surat->jadwal->lokasi_pelayanan ?? '-' }}
                                </td>

                                {{-- Petugas --}}
                                <td class="px-4 py-2">
                                    {{ $surat->jadwal->petugas->nama_lengkap ?? '-' }}
                                </td>

                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($surat->tanggal_terbit)->format('d-m-Y H:i') }}</td>
                                
                                <td class="px-4 py-2 flex flex-wrap gap-2">
                                    <!-- Tombol Download -->
                                    <a href="{{ route('surat.download', $surat) }}" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-sm transition">
                                        Download
                                    </a>

                                    <!-- Tombol Lihat PDF -->
                                    <button 
                                        onclick="openPdfModal('{{ route('surat.preview', $surat) }}')" 
                                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-sm transition">
                                        Lihat PDF
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-6 text-gray-500 italic">
                                    Belum ada surat pemberitahuan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $surats->links('pagination::tailwind') }}
            </div>
            <!-- Modal Preview PDF -->
            <div id="pdfModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-3/4 h-[90vh] relative">
                    <!-- Tombol Tutup -->
                    <button onclick="closePdfModal()" 
                            class="absolute top-3 right-3 bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                        Tutup
                    </button>

                    <!-- Iframe PDF -->
                    <iframe id="pdfFrame" src="" class="w-full h-full rounded-b-lg" frameborder="0"></iframe>
                </div>
            </div>

        </div>
    </div>
    <script>
    function openPdfModal(pdfUrl) {
        document.getElementById('pdfFrame').src = pdfUrl;
        document.getElementById('pdfModal').classList.remove('hidden');
    }

    function closePdfModal() {
        document.getElementById('pdfFrame').src = '';
        document.getElementById('pdfModal').classList.add('hidden');
    }
    </script>

</x-app-layout>
