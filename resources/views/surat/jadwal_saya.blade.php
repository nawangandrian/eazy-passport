<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jadwal Saya') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4">
        {{-- 🌟 Banner Hero Blue Deep Sea --}}
        <div class="bg-gradient-to-r from-blue-800 to-blue-600 rounded-xl text-white p-10 mb-12 shadow-xl relative overflow-hidden">
            <div class="max-w-2xl">
                <h1 class="text-4xl sm:text-5xl font-bold mb-4">Hai, {{ Auth::user()->nama_lengkap }}!</h1>
                <p class="text-lg sm:text-xl mb-6">
                    Semua pemberitahuan terkait surat jadwal layanan Anda ada di sini. Silahkan cek selalu terkait persetujuan jadwal pelayanan.
                </p>
                <a href="{{ route('pendaftaran.create') }}" 
                class="inline-block bg-white text-blue-800 font-semibold px-6 py-3 rounded-xl shadow-md hover:shadow-lg transition transform hover:-translate-y-1">
                    + Tambah Pendaftaran
                </a>
            </div>
            {{-- Ilustrasi / ikon di sisi kanan --}}
            <img src="https://images.unsplash.com/photo-1710010966147-35c53f427a9b?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=873" 
                alt="Ilustrasi Dokumen" 
                class="absolute right-0 bottom-0 w-1/3 opacity-90 hidden sm:block rounded-lg shadow-lg">
            {{-- Ornamen tambahan --}}
            <div class="absolute top-0 left-0 w-32 h-32 bg-white opacity-10 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-40 h-40 bg-white opacity-10 rounded-full translate-x-1/2 translate-y-1/2"></div>
        </div>

        @if($surats->isEmpty())
            <div class="text-center bg-white py-10 px-6 rounded-xl shadow-lg border border-gray-200">
                <!-- Ilustrasi Empty State -->
                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486809.png" 
                    alt="Empty illustration" 
                    class="mx-auto mb-4 w-32 opacity-80">

                <!-- Judul -->
                <h2 class="text-gray-700 font-semibold text-lg mb-2">Belum ada surat</h2>

                <!-- Deskripsi -->
                <p class="text-gray-500 text-sm mb-4">Tidak ada surat untuk jadwal Anda saat ini.</p>

                <!-- Tombol Aksi -->
                <a href="{{ route('pendaftaran.index') }}" 
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold text-sm transition transform hover:-translate-y-1 hover:shadow-md">
                Cek Pendaftaran Anda
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($surats as $surat)
                    {{-- 🌟 Modern Surat Card dengan Motif Kotak Persegi Acak & Icon Surat --}}
                    <div class="relative overflow-hidden rounded-2xl shadow-lg border border-gray-200 transition transform hover:-translate-y-1 duration-300 hover:shadow-2xl">

                        <!-- Konten Card -->
                        <div class="relative flex flex-col justify-between h-full">

                            <!-- Header Card dengan Motif Kotak Acak -->
                            <div class="relative p-6 mb-4 rounded-t-2xl overflow-hidden bg-gradient-to-r from-blue-900 via-blue-800 to-blue-700">

                                <!-- SVG Motif Kotak Persegi Acak -->
                                <svg class="absolute inset-0 w-full h-full opacity-30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 100">
                                    <defs>
                                        <linearGradient id="deepSeaGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#0f2027; stop-opacity:1" />
                                            <stop offset="50%" style="stop-color:#203a43; stop-opacity:1" />
                                            <stop offset="100%" style="stop-color:#2c5364; stop-opacity:1" />
                                        </linearGradient>
                                    </defs>

                                    <!-- Kotak-kotak persegi acak -->
                                    <rect x="10"  y="10" width="12" height="12" fill="url(#deepSeaGradient)" />
                                    <rect x="30"  y="20" width="12" height="12" fill="url(#deepSeaGradient)" />
                                    <rect x="50"  y="5"  width="12" height="12" fill="url(#deepSeaGradient)" />
                                    <rect x="70"  y="25" width="12" height="12" fill="url(#deepSeaGradient)" />
                                    <rect x="90"  y="15" width="12" height="12" fill="url(#deepSeaGradient)" />
                                    <rect x="110" y="30" width="12" height="12" fill="url(#deepSeaGradient)" />
                                    <rect x="130" y="10" width="12" height="12" fill="url(#deepSeaGradient)" />
                                    <rect x="150" y="20" width="12" height="12" fill="url(#deepSeaGradient)" />
                                    <rect x="170" y="5"  width="12" height="12" fill="url(#deepSeaGradient)" />
                                </svg>

                                <!-- Icon Surat Modern -->
                                <div class="absolute top-4 right-4 z-10 text-white opacity-90">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-18 8h18a2 2 0 002-2V6a2 2 0 00-2-2H3a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                </div>

                                <!-- Konten Header -->
                                <span class="inline-block bg-blue-200/30 text-white text-xs font-semibold px-2 py-1 rounded-full mb-2 relative z-10">
                                    Surat Jadwal Layanan
                                </span>
                                
                                <h3 class="text-xl font-bold text-white mb-2 relative z-10">{{ $surat->nomor_surat }}</h3>
                                
                                <p class="text-blue-100 mb-1 relative z-10">
                                    <span class="font-semibold">PIC:</span> {{ $surat->jadwal->pendaftaran->user->nama_lengkap ?? '-' }}
                                </p>
                                <p class="text-blue-200 text-sm mb-1 relative z-10">
                                    <span class="font-semibold">Jadwal:</span> {{ \Carbon\Carbon::parse($surat->jadwal->tanggal_pelayanan)->format('d-m-Y') }}
                                </p>
                                <p class="text-blue-200 text-sm relative z-10"> 
                                    <span class="font-semibold">Tanggal Terbit:</span> {{ \Carbon\Carbon::parse($surat->tanggal_terbit)->format('d-m-Y H:i') }}
                                </p>
                            </div>

                            <!-- Footer Card (Tombol) -->
                            <div class="flex gap-3 p-6 pt-0">
                                <a href="{{ route('surat.download', $surat) }}" 
                                class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-2 rounded-lg text-sm font-semibold text-center transition transform hover:-translate-y-1 hover:shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1 -mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12v8m0 0l-4-4m4 4l4-4M12 4v8"/>
                                </svg>
                                Download
                                </a>

                                <button onclick="openPdfModal('{{ route('surat.preview', $surat) }}')" 
                                class="flex-1 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition transform hover:-translate-y-1 hover:shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1 -mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m0 0l-4-4m4 4l4-4"/>
                                </svg>
                                Lihat PDF
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- PDF Modal --}}
    <div id="pdfModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-3/4 h-[90vh] relative">
            <button onclick="closePdfModal()" 
                    class="absolute top-3 right-3 bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                Tutup
            </button>
            <iframe id="pdfFrame" src="" class="w-full h-full rounded-b-lg" frameborder="0"></iframe>
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
