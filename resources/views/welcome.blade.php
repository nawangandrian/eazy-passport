<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Eazy Passport | Kantor Imigrasi</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white text-gray-800 md:pb-0 pb-16">

    <header class="bg-white shadow-sm fixed w-full z-50 top-0">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <img src="{{ asset('img/logo.png') }}" alt="Logo Imigrasi" class="w-30 h-10">
                <span class="text-xl font-bold text-blue-700">Eazy Passport</span>
            </div>

            <!-- Menu Navigasi Desktop -->
            <nav class="hidden md:flex space-x-8 font-medium text-gray-700">
                <a href="#home" class="hover:text-blue-700 transition">Beranda</a>
                <a href="#about" class="hover:text-blue-700 transition">Tentang</a>
                <a href="#features" class="hover:text-blue-700 transition">Fitur</a>
                <a href="#contact" class="hover:text-blue-700 transition">Kontak</a>
            </nav>

            <!-- Tombol Login & Daftar -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('login') }}" 
                class="px-4 py-2 text-sm font-semibold text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                Login
                </a>
                <a href="{{ route('register') }}" 
                class="px-4 py-2 text-sm font-semibold text-white bg-blue-700 rounded-lg hover:bg-blue-800 transition">
                Daftar
                </a>
            </div>
        </div>
    </header>

    <!-- Menu Navigasi Mobile (fixed di bawah layar) -->
    <nav class="fixed bottom-0 left-0 w-full bg-white shadow-t md:hidden border-t border-gray-200">
        <div class="flex justify-around py-2">
            <a href="#home" class="menu-item flex flex-col items-center text-gray-700 hover:text-blue-700 transition px-3 py-1 rounded-lg">
                <!-- Icon Home -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 4l9 5.75V20a1 1 0 01-1 1h-5v-5H9v5H4a1 1 0 01-1-1V9.75z" />
                </svg>
                <span class="text-xs font-medium">Beranda</span>
            </a>
            <a href="#about" class="menu-item flex flex-col items-center text-gray-700 hover:text-blue-700 transition px-3 py-1 rounded-lg">
                <!-- Icon Info -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 12h.01" />
                </svg>
                <span class="text-xs font-medium">Tentang</span>
            </a>
            <a href="#features" class="menu-item flex flex-col items-center text-gray-700 hover:text-blue-700 transition px-3 py-1 rounded-lg">
                <!-- Icon Features -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span class="text-xs font-medium">Fitur</span>
            </a>
            <a href="#contact" class="menu-item flex flex-col items-center text-gray-700 hover:text-blue-700 transition px-3 py-1 rounded-lg">
                <!-- Icon Contact -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a2 2 0 011.664.832l1.906 2.578a2 2 0 01-.336 2.832L8 12l4 4 2.75-2.25a2 2 0 012.832-.336l2.578 1.906A2 2 0 0121 15.72V19a2 2 0 01-2 2h-1a16 16 0 01-15-15v-1z" />
                </svg>
                <span class="text-xs font-medium">Kontak</span>
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="pt-32 pb-20 bg-gradient-to-r from-blue-50 to-white">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-12">
            <!-- Text -->
            <div class="flex-1">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 leading-tight">
                    Sistem Pendaftaran <span class="text-blue-700">Eazy Passport</span> Berbasis Web
                </h1>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Kantor Imigrasi merupakan unit pelaksana teknis di bawah Direktorat Jenderal Imigrasi 
                    yang memberikan layanan keimigrasian seperti penerbitan paspor, izin tinggal, serta pengawasan orang asing. 
                    Melalui inovasi <strong>Eazy Passport</strong>, pembuatan paspor kolektif kini dapat dilakukan dengan lebih mudah — 
                    petugas datang langsung ke lokasi pemohon tanpa perlu ke kantor imigrasi.
                </p>
                <div class="flex gap-4">
                    <a href="{{ route('register') }}" class="bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition">Daftar Sekarang</a>
                    <a href="#about" class="px-6 py-3 border border-blue-700 text-blue-700 rounded-lg font-semibold hover:bg-blue-50 transition">Pelajari Lebih Lanjut</a>
                </div>
            </div>

            <!-- Image -->
            <div class="flex-1 text-center">
                <img src="https://images.unsplash.com/photo-1606857521015-7f9fcf423740?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=870" alt="Eazy Passport" class="w-full max-w-md mx-auto">
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-6 text-blue-700">Tentang Eazy Passport</h2>
            <p class="text-gray-600 leading-relaxed max-w-3xl mx-auto">
                Layanan Eazy Passport memudahkan masyarakat dalam pengurusan paspor secara kolektif. 
                Pemohon tidak perlu datang ke kantor imigrasi karena petugas akan mendatangi lokasi pemohon, 
                seperti sekolah, kantor, atau komunitas. Pengajuan dilakukan oleh perwakilan kelompok minimal 50 pemohon. 
                Dengan sistem berbasis web, proses pendaftaran menjadi lebih cepat, transparan, dan efisien.
            </p>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-blue-700 mb-12">Fitur Unggulan</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-8 bg-white shadow-lg rounded-2xl">
                    <h3 class="text-xl font-semibold mb-3 text-blue-700">Pendaftaran Online</h3>
                    <p class="text-gray-600">Pemohon dapat mengisi data dan mengunggah dokumen langsung melalui sistem, tanpa perlu pengisian manual.</p>
                </div>
                <div class="p-8 bg-white shadow-lg rounded-2xl">
                    <h3 class="text-xl font-semibold mb-3 text-blue-700">Pemantauan Jadwal</h3>
                    <p class="text-gray-600">Petugas dapat memantau jumlah pemohon dan menentukan jadwal layanan secara lebih optimal.</p>
                </div>
                <div class="p-8 bg-white shadow-lg rounded-2xl">
                    <h3 class="text-xl font-semibold mb-3 text-blue-700">Layanan Efisien</h3>
                    <p class="text-gray-600">Proses pengajuan, validasi, dan pelayanan menjadi lebih cepat, transparan, dan terdokumentasi dengan baik.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="bg-blue-900 text-white py-10 mt-20">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h3 class="text-lg font-semibold mb-4">Kantor Imigrasi Kelas I Non TPI Pati</h3>
            <p class="text-gray-200 mb-2">Jl. Dr. Susanto No. 10, Pati, Jawa Tengah</p>
            <p class="text-gray-300 mb-6">Telepon: (0295) 381708 | Email: info@imigrasipati.go.id</p>
            <p class="text-sm text-gray-400">© 2025 Eazy Passport. All rights reserved.</p>
        </div>
    </footer>

</body>
<script>
// Script untuk highlight section aktif
const sections = document.querySelectorAll('section');
const menuItems = document.querySelectorAll('.menu-item');

window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(section => {
        const sectionTop = section.offsetTop - 60; 
        if (scrollY >= sectionTop) {
            current = section.getAttribute('id');
        }
    });

    menuItems.forEach(item => {
        item.classList.remove('bg-blue-100', 'text-blue-700');
        if(item.getAttribute('href') === '#' + current) {
            item.classList.add('bg-blue-100', 'text-blue-700');
        }
    });
});
</script>
</html>
