<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pendaftaran') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4">

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- 🌟 Banner Hero --}}
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl text-white p-10 mb-12 shadow-lg relative overflow-hidden">
            <div class="max-w-2xl">
                <h1 class="text-4xl sm:text-5xl font-bold mb-4">Selamat Datang, {{ Auth::user()->nama_lengkap }}!</h1>
                <p class="text-lg sm:text-xl mb-6">Mulai proses Eazy Passport Anda dengan mudah dan cepat. Lihat alur pengajuan di bawah ini.</p>
                <a href="{{ route('pendaftaran.create') }}" 
                class="inline-block bg-white text-blue-700 font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                    + Pendaftaran Baru
                </a>
            </div>
            {{-- Ilustrasi / gambar di sisi kanan --}}
            <img src="https://images.unsplash.com/photo-1547572848-7009c748c5b8?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=300" 
                alt="Ilustrasi Passport" 
                class="absolute right-0 bottom-0 w-1/3 opacity-80 hidden sm:block rounded-lg">
        </div>

        {{-- 🌟 Cards Alur Pengajuan --}}
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Alur Pendaftaran Eazy Passport</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">

            {{-- Card 1 --}}
            <div class="bg-gradient-to-b from-blue-50 to-white rounded-xl shadow-md p-6 hover:shadow-xl transition duration-300 border-l-4 border-blue-800">
                <img src="https://cdn-icons-png.flaticon.com/512/2910/2910763.png" 
                    alt="Formulir" class="w-16 h-16 mb-4">
                <h3 class="text-xl font-semibold mb-2 text-blue-900">1. Isi Formulir</h3>
                <p class="text-gray-600">Lengkapi data PIC dan pemohon dengan benar untuk memulai pendaftaran paspor.</p>
            </div>

            {{-- Card 2 --}}
            <div class="bg-gradient-to-b from-blue-50 to-white rounded-xl shadow-md p-6 hover:shadow-xl transition duration-300 border-l-4 border-blue-800">
                <img src="https://cdn-icons-png.flaticon.com/512/2910/2910765.png" 
                    alt="Upload Dokumen" class="w-16 h-16 mb-4">
                <h3 class="text-xl font-semibold mb-2 text-blue-900">2. Unggah Dokumen</h3>
                <p class="text-gray-600">Unggah KTP, KK, paspor lama (jika ada) dan dokumen pendukung lainnya.</p>
            </div>

            {{-- Card 3 --}}
            <div class="bg-gradient-to-b from-blue-50 to-white rounded-xl shadow-md p-6 hover:shadow-xl transition duration-300 border-l-4 border-blue-800">
                <img src="https://cdn-icons-png.flaticon.com/512/2910/2910770.png" 
                    alt="Jadwal" class="w-16 h-16 mb-4">
                <h3 class="text-xl font-semibold mb-2 text-blue-900">3. Cek Jadwal Layanan</h3>
                <p class="text-gray-600">Pantau jadwal pelayanan dan status verifikasi dari petugas secara real-time.</p>
            </div>

        </div>

        {{-- 🌟 ROLE: PIC - Tampilan Kartu Modern --}}
        @if (Auth::user()->role === 'PIC')
            <div class="mb-8">
                <a href="{{ route('pendaftaran.create') }}" 
                class="block w-full sm:w-auto bg-blue-700 hover:bg-blue-800 text-white text-center font-semibold 
                        px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 
                        transform hover:-translate-y-1">
                    + Pendaftaran Baru
                </a>
            </div>

            @if ($pendaftarans->isEmpty())
                <div class="text-center bg-white py-10 rounded-xl shadow-md">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486809.png" 
                         alt="Empty illustration" class="mx-auto mb-4 w-40 opacity-80">
                    <h2 class="text-gray-700 font-semibold text-lg">Belum ada pendaftaran.</h2>
                    <p class="text-gray-500 text-sm mt-1">Klik tombol di atas untuk membuat pendaftaran baru.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($pendaftarans as $item)
                        @php
                            $images = [
                                'https://plus.unsplash.com/premium_photo-1663127104392-609b4c06699b?ixlib=rb-4.1.0&auto=format&fit=crop&q=80&w=918',
                                'https://plus.unsplash.com/premium_photo-1663091150082-fc813e8a13a4?ixlib=rb-4.1.0&auto=format&fit=crop&q=80&w=870',
                                'https://plus.unsplash.com/premium_photo-1663054311916-98ef24980a37?ixlib=rb-4.1.0&auto=format&fit=crop&q=80&w=870',
                            ];
                        @endphp
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 overflow-hidden border border-gray-100">
                            <img src="{{ $images[array_rand($images)] }}" 
                            alt="Layanan" class="w-full h-40 object-cover">
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-blue-800">{{ $item->lokasi_layanan }}</h3>
                                <div class="flex justify-between mt-1 text-sm text-gray-600">
                                    <p>
                                        <span class="font-semibold">Jenis:</span> {{ $item->jenis_layanan }}
                                    </p>
                                    <p>
                                        <span class="font-semibold"></span> {{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d-m-Y H:i') }}
                                    </p>
                                </div>

                                <p class="text-gray-600 mt-1 text-sm">
                                    <span class="font-semibold">Jumlah Pemohon:</span> {{ $item->jumlah_pemohon }}
                                </p>
                                <div class="mt-1 flex justify-between items-center">
                                    <!-- Status -->
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full
                                        @if($item->status_verifikasi == 'Menunggu') bg-yellow-100 text-yellow-700
                                        @elseif($item->status_verifikasi == 'Valid') bg-green-100 text-green-700
                                        @elseif($item->status_verifikasi == 'Tidak Valid') bg-red-100 text-red-700
                                        @else bg-orange-100 text-orange-700 @endif">
                                        {{ $item->status_verifikasi }}
                                    </span>

                                    <a href="{{ route('pemohon.index', ['pendaftaran' => $item->pendaftaran_id]) }}" 
                                    class="px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded hover:bg-blue-600">
                                    Lihat Pemohon
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        {{-- 🧑‍💼 ROLE: PETUGAS - Tampilan Tabel --}}
        @elseif (Auth::user()->role === 'PETUGAS')

            {{-- Card Container --}}
            <div class="bg-white shadow-lg rounded-xl border border-gray-200 p-6">

                <!-- Header -->
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
                    <h1 class="text-2xl font-bold text-blue-800 mb-4 sm:mb-0">Daftar Pendaftaran</h1>

                    <!-- Form Search -->
                    <form method="GET" action="{{ route('pendaftaran.index') }}" class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="🔍 Cari berdasarkan nama PIC, lokasi, atau jenis layanan..." 
                            class="w-full sm:w-64 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                        />
                        <button 
                            type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-md transition font-medium">
                            Cari
                        </button>
                    </form>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-700 rounded-lg">
                        <thead class="bg-blue-900 text-white uppercase text-xs tracking-wider">
                            <tr>
                                <th class="px-6 py-3 rounded-tl-lg">#</th>
                                <th class="px-6 py-3">PIC</th>
                                <th class="px-6 py-3">Lokasi</th>
                                <th class="px-6 py-3">Jenis Layanan</th>
                                <th class="px-6 py-3">Tanggal</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3 text-center rounded-tr-lg">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pendaftarans as $item)
                                <tr class="border-b hover:bg-blue-50 transition">
                                    <td class="px-6 py-3">{{ $pendaftarans->firstItem() + $loop->index }}</td>
                                    <td class="px-6 py-3 font-medium text-gray-800">{{ $item->user->nama_lengkap ?? '-' }}</td>
                                    <td class="px-6 py-3">{{ $item->lokasi_layanan }}</td>
                                    <td class="px-6 py-3">{{ $item->jenis_layanan }}</td>
                                    <td class="px-6 py-3">{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d-m-Y H:i') }}</td>
                                    <td class="px-6 py-3">
                                        @php
                                            $statusColors = [
                                                'Menunggu' => 'bg-yellow-100 text-yellow-800',
                                                'Valid' => 'bg-green-100 text-green-800',
                                                'Tidak Valid' => 'bg-red-100 text-red-800',
                                            ];
                                            $colorClass = $statusColors[$item->status_verifikasi] ?? 'bg-orange-100 text-orange-800';
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $colorClass }}">
                                            {{ $item->status_verifikasi }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-3 text-center">
                                        <a href="{{ route('pemohon.index', ['pendaftaran' => $item->pendaftaran_id]) }}" 
                                            class="inline-flex items-center gap-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-sm transition">
                                            👁️ Lihat Pemohon
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-6 text-center text-gray-500 italic">
                                        Belum ada data pendaftaran ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $pendaftarans->links('pagination::tailwind') }}
                </div>

            </div>

        @else
            <div class="text-gray-600 italic">Role tidak dikenali.</div>
        @endif
    </div>
</x-app-layout>
