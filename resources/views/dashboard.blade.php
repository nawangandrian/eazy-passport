<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Eazy Passport
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- 🌍 Modern Flat Hero Section (Eazy Passport) -->
            <section class="relative overflow-hidden bg-gradient-to-br from-blue-50 via-white to-blue-100 text-gray-800 rounded-2xl shadow-xl mb-12">
                <div class="container mx-auto px-6 lg:px-16 py-20 flex flex-col-reverse lg:flex-row items-center justify-between gap-12">
                    
                    <!-- 🧭 Left Content -->
                    <div class="flex-1 text-center lg:text-left">
                        <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-4">
                            Layanan <span class="text-blue-600">Paspor</span> Mudah & Cepat
                        </h1>
                        <p class="text-lg text-gray-600 mb-8 max-w-xl mx-auto lg:mx-0">
                            Kelola proses pendaftaran dan verifikasi paspor dengan sistem digital yang <span class="font-semibold text-blue-700">efisien</span>, 
                            <span class="font-semibold text-blue-700">terintegrasi</span>, dan <span class="font-semibold text-blue-700">praktis</span>.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <a href="{{ route('pendaftaran.index') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition transform hover:-translate-y-1 hover:shadow-xl">
                                🚀 Mulai Sekarang
                            </a>
                            <a href="{{ route('dashboard') }}"
                            class="border border-blue-600 text-blue-700 hover:bg-blue-600 hover:text-white font-semibold px-6 py-3 rounded-lg transition transform hover:-translate-y-1">
                                Lihat Fitur
                            </a>
                        </div>
                    </div>

                    <!-- 🌐 Right SVG Illustration -->
                    <div class="flex-1 flex justify-center lg:justify-end">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 900 600" class="w-[480px] h-auto">
                            <!-- Background shapes -->
                            <circle cx="450" cy="300" r="240" fill="#DBEAFE"/>
                            <circle cx="450" cy="300" r="180" fill="#BFDBFE"/>
                            <circle cx="450" cy="300" r="120" fill="#93C5FD"/>
                            
                            <!-- Passport Book -->
                            <rect x="370" y="180" width="160" height="230" rx="12" ry="12" fill="#1E40AF" stroke="#1E3A8A" stroke-width="4"/>
                            <rect x="385" y="195" width="130" height="200" rx="8" ry="8" fill="#2563EB"/>
                            
                            <!-- Passport Globe Icon -->
                            <circle cx="450" cy="290" r="45" fill="none" stroke="#EFF6FF" stroke-width="4"/>
                            <path d="M450 245 A45 45 0 0 0 450 335 M405 290 H495" stroke="#EFF6FF" stroke-width="3"/>
                            <path d="M432 245 C440 270,440 310,432 335 M468 245 C460 270,460 310,468 335" stroke="#EFF6FF" stroke-width="3"/>

                            <!-- Text “PASSPORT” -->
                            <text x="450" y="360" text-anchor="middle" font-size="20" fill="#EFF6FF" font-family="sans-serif" font-weight="bold">PASSPORT</text>

                            <!-- Floating Icons (decorative) -->
                            <circle cx="300" cy="180" r="12" fill="#60A5FA" opacity="0.9">
                                <animate attributeName="cy" values="180;175;180" dur="3s" repeatCount="indefinite"/>
                            </circle>
                            <circle cx="600" cy="420" r="10" fill="#3B82F6" opacity="0.8">
                                <animate attributeName="cy" values="420;415;420" dur="4s" repeatCount="indefinite"/>
                            </circle>
                            <circle cx="520" cy="140" r="8" fill="#93C5FD" opacity="0.7">
                                <animate attributeName="cy" values="140;135;140" dur="3.5s" repeatCount="indefinite"/>
                            </circle>
                        </svg>
                    </div>
                </div>

                <!-- Decorative Blur Element -->
                <div class="absolute top-0 left-0 w-96 h-96 bg-blue-300 rounded-full blur-3xl opacity-20 -z-10"></div>
                <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-500 rounded-full blur-3xl opacity-20 -z-10"></div>
            </section>

            <!-- Informasi Tambahan -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h3 class="text-xl font-semibold mb-3 text-gray-800">Tentang Eazy Passport</h3>
                <p class="text-gray-700 leading-relaxed">
                    <strong>Eazy Passport</strong> adalah sistem layanan paspor berbasis digital yang dirancang untuk mempermudah masyarakat 
                    dalam proses pengajuan dan verifikasi paspor tanpa harus melalui prosedur manual yang rumit. 
                    Dengan sistem ini, seluruh proses mulai dari pendaftaran, pengunggahan dokumen, hingga validasi dapat dilakukan secara cepat, aman, dan efisien.
                </p>
            </div>

            <!-- Informasi Sistem -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition">
                    <div class="flex items-center mb-3">
                        <div class="bg-blue-100 text-blue-700 p-3 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8c-1.1 0-2 .9-2 2v6h4v-6c0-1.1-.9-2-2-2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Layanan Cepat</h3>
                    </div>
                    <p class="text-gray-600">
                        Proses pendaftaran dan validasi dilakukan secara digital, 
                        meminimalkan waktu antre dan kesalahan administrasi.
                    </p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition">
                    <div class="flex items-center mb-3">
                        <div class="bg-green-100 text-green-700 p-3 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Validasi Mudah</h3>
                    </div>
                    <p class="text-gray-600">
                        Setiap pendaftaran dapat divalidasi dengan satu klik, 
                        dan status langsung terupdate secara real-time.
                    </p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition">
                    <div class="flex items-center mb-3">
                        <div class="bg-yellow-100 text-yellow-700 p-3 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 11c0-1.657 1.343-3 3-3h6m-6 0V5a2 2 0 00-2-2H6a2 2 0 00-2 2v6m0 6a2 2 0 002 2h6a2 2 0 002-2v-6" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Data Terpusat</h3>
                    </div>
                    <p class="text-gray-600">
                        Semua data pemohon dan dokumen tersimpan secara aman dalam sistem terpusat, 
                        mudah diakses kapan pun dibutuhkan.
                    </p>
                </div>
            </div>

            <!-- Alur Layanan Pengajuan -->
            <div class="bg-white rounded-lg shadow-md p-8 mb-10">
                <h3 class="text-2xl font-semibold text-gray-800 text-center mb-8">
                    Alur Layanan Pengajuan Eazy Passport
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                    <!-- Langkah 1 -->
                    <div class="flex flex-col items-center text-center">
                        <div class="bg-blue-600 text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mb-3 shadow-lg">
                            1
                        </div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Pengajuan</h4>
                        <p class="text-gray-600 text-sm">
                            PIC atau pemohon mengajukan permohonan layanan paspor secara online melalui sistem Eazy Passport.
                        </p>
                    </div>

                    <!-- Langkah 2 -->
                    <div class="flex flex-col items-center text-center">
                        <div class="bg-indigo-600 text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mb-3 shadow-lg">
                            2
                        </div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Unggah Dokumen</h4>
                        <p class="text-gray-600 text-sm">
                            Pemohon melengkapi dokumen pendukung seperti KTP, KK, paspor lama, dan akta kelahiran.
                        </p>
                    </div>

                    <!-- Langkah 3 -->
                    <div class="flex flex-col items-center text-center">
                        <div class="bg-green-600 text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mb-3 shadow-lg">
                            3
                        </div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Validasi Data</h4>
                        <p class="text-gray-600 text-sm">
                            Petugas memeriksa kelengkapan data dan dokumen. Jika valid, status pendaftaran diperbarui menjadi “Terverifikasi”.
                        </p>
                    </div>

                    <!-- Langkah 4 -->
                    <div class="flex flex-col items-center text-center">
                        <div class="bg-yellow-500 text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mb-3 shadow-lg">
                            4
                        </div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Proses Layanan</h4>
                        <p class="text-gray-600 text-sm">
                            Petugas melakukan proses pembuatan jadwal layanan sesuai dengan ketentuan layanan yang berlaku.
                        </p>
                    </div>

                    <!-- Langkah 5 -->
                    <div class="flex flex-col items-center text-center">
                        <div class="bg-emerald-600 text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mb-3 shadow-lg">
                            5
                        </div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Pengumunan Pelayanan</h4>
                        <p class="text-gray-600 text-sm">
                            Pemohon dapat melihat jadwal layanan yang telah jadi sesuai surat peberitahuan jadwal yang ditentukan.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
