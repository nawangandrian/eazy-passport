<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Buat Surat Pemberitahuan</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-6">

                {{-- Error Validation --}}
                @if($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>- {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- === FORM UTAMA SIMPAN SURAT === --}}
                <form action="{{ route('surat.store') }}" method="POST" enctype="multipart/form-data" id="formSurat">
                    @csrf

                    <!-- Jadwal -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Jadwal Layanan</label>
                        <input type="text" class="w-full border-gray-300 rounded px-3 py-2" 
                               value="{{ \Carbon\Carbon::parse($jadwal->tanggal_pelayanan)->format('d-m-Y') }} | {{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}" 
                               disabled>
                        <input type="hidden" name="jadwal_id" value="{{ $jadwal->jadwal_id }}">
                    </div>

                    <!-- Nomor Surat -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Nomor Surat</label>
                        <input type="text" name="nomor_surat" id="nomor_surat" class="w-full border-gray-300 rounded px-3 py-2" required>
                    </div>

                    <!-- Kepala Dinas -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Nama Kepala Dinas / Pejabat Penandatangan</label>
                        <input type="text" name="nama_kepala" id="nama_kepala" class="w-full border-gray-300 rounded px-3 py-2" required placeholder="Contoh: Drs. Ahmad Suryanto, M.Si">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Jabatan Kepala Dinas</label>
                        <input type="text" name="jabatan_kepala" id="jabatan_kepala" class="w-full border-gray-300 rounded px-3 py-2" required placeholder="Contoh: Kepala Kantor Imigrasi Kelas I Non TPI Pati">
                    </div>

                    <!-- Preview Surat Resmi -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Preview Surat Resmi</label>
                        <div class="border p-6 rounded bg-gray-50 text-gray-800" style="font-family: 'Times New Roman', serif; line-height: 1.6;">
                            
                            {{-- === KOP SURAT === --}}
                            <div class="relative text-center mb-6">
                                <!-- Logo Kiri -->
                                <img src="{{ asset('img/logo-imigrasi.png') }}" 
                                    alt="Logo Imigrasi" 
                                    class="absolute left-0 top-0 w-14 h-14 object-contain">

                                <!-- Teks Tengah -->
                                <div class="px-16"> {{-- beri padding agar teks tidak nabrak logo --}}
                                    <h2 class="font-bold text-lg uppercase">PEMERINTAH KABUPATEN PATI</h2>
                                    <h2 class="font-bold text-lg uppercase">KANTOR IMIGRASI KELAS I NON TPI PATI</h2>
                                    <p class="text-sm leading-tight">
                                        Jl. Raya Pati-Kudus Km.7 No.1 Kec. Margorejo, Lumpur, Bumirejo, Kec. Pati, Kabupaten Pati, Jawa Tengah 59163<br>
                                        Telp: +62 812 5703 8946 | Email: info@imigrasipati.id
                                    </p>
                                </div>

                                <!-- Logo Kanan -->
                                <img src="{{ asset('img/logo-tpi.png') }}" 
                                    alt="Logo TPI" 
                                    class="absolute right-0 top-0 w-14 h-14 object-contain">

                                <!-- Garis Pembatas -->
                                <hr class="border-t-2 border-black mt-3">
                            </div>

                            {{-- === TANGGAL (rata kanan) === --}}
                            <p class="text-right">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>

                            {{-- === INFORMASI SURAT === --}}
                            <div class="mb-4">
                                <div class="flex mb-1">
                                    <span class="w-20 font-semibold">Nomor</span>
                                    <span>: <a id="preview_nomor_surat">-</a></span>
                                </div>
                                <div class="flex mb-1">
                                    <span class="w-20 font-semibold">Lampiran</span>
                                    <span>: -</span>
                                </div>
                                <div class="flex">
                                    <span class="w-20 font-semibold">Perihal</span>
                                    <span>: <strong>Pemberitahuan Jadwal Layanan</strong></span>
                                </div>
                            </div>

                            {{-- === KEPADA YTH === --}}
                            <div class="mb-4">
                                <p class="m-0">Kepada Yth.</p>
                                <p class="m-0"><strong>{{ strtoupper($pembuat->nama_lengkap) }}</strong></p>
                                <p class="m-0">{{ $pembuat->email }}</p>
                                <p class="m-0">Di tempat</p>
                            </div>

                            {{-- === ISI SURAT === --}}
                            <div class="mb-6 text-justify leading-relaxed text-[15px]">
                                <p class="mb-3">Dengan hormat,</p>

                                <p class="mb-3 indent-8">
                                    Sehubungan dengan jadwal layanan <span class="font-semibold">Eazy Passport</span> yang telah ditetapkan,
                                    bersama ini kami memberitahukan bahwa pelayanan akan dilaksanakan pada:
                                </p>

                                <div class="ml-8 mb-3">
                                    <p>
                                        <span class="inline-block w-28">Tanggal</span>:
                                        {{ \Carbon\Carbon::parse($jadwal->tanggal_pelayanan)->translatedFormat('d F Y') }}
                                    </p>
                                    <p>
                                        <span class="inline-block w-28">Waktu</span>:
                                        {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }}
                                        WIB
                                    </p>
                                    <p>
                                        <span class="inline-block w-28">Lokasi</span>:
                                        {{ $jadwal->lokasi_pelayanan }}
                                    </p>
                                </div>

                                <p class="mb-3 indent-8">
                                    Diharapkan kepada perwakilan pemohon agar hadir tepat waktu dan membawa seluruh dokumen yang diperlukan
                                    sesuai ketentuan yang berlaku.
                                </p>

                                <p class="indent-8">
                                    Demikian surat pemberitahuan ini kami sampaikan. Atas perhatian dan kerja samanya kami ucapkan terima kasih.
                                </p>
                            </div>

                            {{-- === PENUTUP (TANDA TANGAN RATA KANAN) === --}}
                            <div class="text-right mt-8 mr-8">
                                <p>Pati, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                                <p id="preview_jabatan_kepala">[Jabatan]</p><br><br><br>
                                <p><strong id="preview_nama_kepala">[Nama Pejabat / Kepala Dinas]</strong></p>
                            </div>
                            
                        </div>
                    </div>

                    <!-- File Surat -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Upload File Surat (PDF)</label>
                        <input type="file" name="file_surat" accept="application/pdf" class="w-full border-gray-300 rounded px-3 py-2" required>
                    </div>

                    <!-- PIC Penerima -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">PIC Penerima</label>
                        <select name="diterima_oleh" class="w-full border-gray-300 rounded px-3 py-2" required>
                            <option value="">-- Pilih PIC --</option>
                            <option value="{{ $pembuat->user_id }}" selected>
                                {{ $pembuat->nama_lengkap }} ({{ $pembuat->email }})
                            </option>
                        </select>
                        <small class="text-gray-500">PIC otomatis sesuai pemohon jadwal ini, bisa diubah jika diperlukan.</small>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex justify-end gap-3">
                        {{-- <button type="button" id="btnPrintPreview" 
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                            Cetak Preview
                        </button> --}}

                        <button type="button" id="btnCetakPdf" 
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                            Cetak PDF
                        </button>

                        <a href="{{ route('surat.index') }}" 
                            class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded">
                            Batal
                        </a>

                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Simpan Surat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Form tersembunyi untuk cetak PDF --}}
    <form id="pdfForm" action="{{ route('surat.generatePdf', $jadwal->jadwal_id) }}" method="POST" target="_blank" class="hidden">
        @csrf
        <input type="hidden" name="nomor_surat" id="pdf_nomor_surat">
        <input type="hidden" name="nama_kepala" id="pdf_nama_kepala">
        <input type="hidden" name="jabatan_kepala" id="pdf_jabatan_kepala">
    </form>

    <script>
        const btnPrintPreview = document.getElementById('btnPrintPreview');

        btnPrintPreview.addEventListener('click', function () {
            const previewContent = document.querySelector('.border.p-6.rounded.bg-gray-50');
            if (!previewContent) {
                alert('Preview surat belum tersedia.');
                return;
            }

            // Ambil semua <link rel="stylesheet"> dari halaman utama, termasuk Tailwind
            const stylesheets = Array.from(document.querySelectorAll('link[rel="stylesheet"], style'))
                .map(link => link.outerHTML)
                .join('\n');

            // Buka jendela print baru
            const printWindow = window.open('', '', 'width=900,height=700');

            // Tulis dokumen dengan Tailwind + konten preview
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Cetak Preview Surat</title>
                        ${stylesheets}
                        <style>
                            @media print {
                                body { background: white !important; color: black !important; }
                                img { display: inline-block; }
                                .no-print { display: none !important; }
                            }
                            body { padding: 2rem; }
                        </style>
                    </head>
                    <body class="bg-gray-50 text-gray-800">
                        ${previewContent.outerHTML}
                    </body>
                </html>
            `);

            printWindow.document.close();
            printWindow.focus();

            // Tunggu Tailwind selesai dimuat baru print
            printWindow.onload = function () {
                setTimeout(() => {
                    printWindow.print();
                    printWindow.close();
                }, 500);
            };
        });
    </script>

    <script>
        const nomorInput = document.getElementById('nomor_surat');
        const previewNomor = document.getElementById('preview_nomor_surat');
        const pdfNomor = document.getElementById('pdf_nomor_surat');
        const btnCetak = document.getElementById('btnCetakPdf');
        const pdfForm = document.getElementById('pdfForm');
        const namaKepala = document.getElementById('nama_kepala');
        const jabatanKepala = document.getElementById('jabatan_kepala');
        const pdfNamaKepala = document.getElementById('pdf_nama_kepala');
        const pdfJabatanKepala = document.getElementById('pdf_jabatan_kepala');
        const namaKepalaInput = document.getElementById('nama_kepala');
        const jabatanKepalaInput = document.getElementById('jabatan_kepala');
        const previewNamaKepala = document.getElementById('preview_nama_kepala');
        const previewJabatanKepala = document.getElementById('preview_jabatan_kepala');

        namaKepalaInput.addEventListener('input', function() {
            previewNamaKepala.textContent = this.value || '[Nama Pejabat / Kepala Dinas]';
        });
        jabatanKepalaInput.addEventListener('input', function() {
            previewJabatanKepala.textContent = this.value || '[Jabatan]';
        });

        // Update nomor surat di preview & hidden input PDF
        nomorInput.addEventListener('input', function () {
            previewNomor.textContent = this.value || '-';
            pdfNomor.value = this.value;
        });

        // Kirim form PDF ketika tombol ditekan
        btnCetak.addEventListener('click', function () {
            if (!nomorInput.value.trim()) {
                alert('Isi nomor surat terlebih dahulu!');
                return;
            }
            pdfNamaKepala.value = namaKepala.value;
            pdfJabatanKepala.value = jabatanKepala.value;
            pdfForm.submit();
        });
    </script>

</x-app-layout>
