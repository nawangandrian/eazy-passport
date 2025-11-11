<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pemohon') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4">

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Aturan Pendaftaran Card --}}
        <div class="mb-4 p-4 bg-yellow-100 border-l-4 border-yellow-500 rounded shadow-sm">
            <h3 class="font-bold text-lg mb-2">📌 Aturan Pendaftaran Eazy Passport</h3>
            <ul class="list-disc list-inside text-sm text-gray-700">
                <li>Pendaftaran dilakukan oleh perwakilan kelompok pemohon (PIC).</li>
                <li>Jumlah minimal pemohon dalam satu pendaftaran adalah <strong>50 orang</strong>.</li>
                <li>Pemohon harus melengkapi dokumen KTP, KK, Akta Kelahiran, dan Paspor Lama (jika ada).</li>
                <li>Jenis layanan yang tersedia: Paspor Baru / Penggantian & Reguler / Percepatan.</li>
                <li>Lokasi layanan ditentukan saat pendaftaran.</li>
                <li>Petugas akan melakukan verifikasi sebelum jadwal pelayanan ditetapkan.</li>
            </ul>
        </div>

        {{-- Search Form --}}
        <div class="flex justify-between items-center mb-4">
            <form action="{{ route('pemohon.index', $pendaftaran->pendaftaran_id) }}" method="GET" class="flex items-center space-x-2">
                <input type="text" name="search" placeholder="Cari nama / NIK..." 
                    value="{{ request('search') }}"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" 
                    class="px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition">Cari</button>
            </form>

            @if(auth()->user()->role == 'PETUGAS')
                <form action="{{ route('pendaftaran.validasi', $pendaftaran->pendaftaran_id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow-md transition">
                        Validasi Pendaftaran
                    </button>
                </form>
            @else
                <a href="{{ route('pemohon.create', $pendaftaran->pendaftaran_id) }}" 
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow-md transition">
                    + Tambah Pemohon
                </a>
            @endif
        </div>

        {{-- Tabel Pemohon --}}
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg border border-gray-100">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="bg-blue-900 text-white uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3">#</th>
                        <th class="px-6 py-3">Nama Lengkap</th>
                        <th class="px-6 py-3">NIK</th>
                        <th class="px-6 py-3">Tanggal Lahir</th>
                        <th class="px-6 py-3">No Telepon</th>
                        <th class="px-6 py-3">Alamat</th>
                        <th class="px-6 py-3">No Paspor Lama</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pemohons as $index => $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-3">{{ $pemohons->firstItem() + $index }}</td>
                            <td class="px-6 py-3">{{ $item->nama_lengkap }}</td>
                            <td class="px-6 py-3">{{ $item->nik }}</td>
                            <td class="px-6 py-3">{{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d-m-Y') }}</td>
                            <td class="px-6 py-3">{{ $item->no_telepon }}</td>
                            <td class="px-6 py-3">{{ $item->alamat }}</td>
                            <td class="px-6 py-3">{{ $item->no_paspor_lama ?? '-' }}</td>
                            @if(auth()->user()->role == 'PIC')
                            <td class="px-6 py-3 flex space-x-2">
                                <!-- Tombol Edit -->
                                <a href="{{ route('pemohon.edit', [$item->pendaftaran_id, $item->pemohon_id]) }}"
                                class="px-3 py-1 text-sm bg-blue-500 text-white rounded hover:bg-blue-600">
                                Edit
                                </a>

                                <!-- Tombol Delete -->
                                <form action="{{ route('pemohon.destroy', [$item->pendaftaran_id, $item->pemohon_id]) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus pemohon ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                            @endif
                            <td class="px-6 py-3 flex space-x-2 items-center" x-data="{ open: false }">
                                <!-- Tombol Lihat Dokumen -->
                                <button @click="open = true" class="px-3 py-1 text-sm bg-green-500 text-white rounded hover:bg-green-600">
                                    Lihat Semua Dokumen
                                </button>

                                <!-- Modal Dokumen -->
                                <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                    <div class="bg-white rounded-lg w-11/12 max-w-3xl p-6 relative">
                                        <!-- Judul Modal -->
                                        <h3 class="text-xl font-bold mb-2">📄 Dokumen Pemohon: {{ $item->nama_lengkap }}</h3>
                                        <p class="text-gray-600 text-sm mb-4">Berikut daftar dokumen yang telah diunggah oleh pemohon. Klik "Lihat" untuk membuka dokumen di tab baru.</p>

                                        <!-- Tombol Tutup -->
                                        <button @click="open = false" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 text-2xl font-bold">&times;</button>

                                        <!-- Daftar Dokumen -->
                                        <div class="grid grid-cols-2 gap-4">
                                            @php
                                                $dokumenList = ['KTP','KK','Paspor_Lama','Akta_Kelahiran'];
                                            @endphp
                                            @foreach($dokumenList as $doc)
                                                @php
                                                    $existingDoc = $item->dokumens->where('jenis_dokumen', $doc)->first();
                                                @endphp
                                                <div class="p-2 border rounded bg-gray-50">
                                                    <p class="text-sm font-semibold">{{ $doc }}</p>
                                                    @if($existingDoc)
                                                        <a href="{{ asset('storage/'.$existingDoc->file_path) }}" target="_blank"
                                                        class="text-blue-600 underline text-sm hover:text-blue-800">
                                                            📂 Klik untuk melihat dokumen
                                                        </a>
                                                    @else
                                                        <span class="text-gray-400 text-sm italic">❌ Dokumen belum diunggah</span>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-3 text-center text-gray-500">
                                Belum ada data pemohon.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $pemohons->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
