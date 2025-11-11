<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Dashboard Eazy Passport
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Banner / Hero Section -->
            <div class="relative rounded-xl overflow-hidden shadow-lg mb-10">
                <img src="https://images.unsplash.com/photo-1521295121783-8a321d551ad2?auto=format&fit=crop&w=1600&q=80" 
                     alt="Banner Eazy Passport" 
                     class="w-full h-72 object-cover brightness-75">

                <div class="absolute inset-0 bg-blue-900/50 flex flex-col justify-center items-center text-center text-white p-6">
                    <h1 class="text-4xl font-bold mb-3">Selamat Datang di <span class="text-yellow-300">Eazy Passport</span></h1>
                    <p class="max-w-2xl text-blue-100 text-lg">
                        Sistem pelayanan paspor yang praktis, cepat, dan terintegrasi. 
                        Kini Anda dapat mengelola pendaftaran dan pemohon dalam satu platform.
                    </p>
                </div>
            </div>

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
