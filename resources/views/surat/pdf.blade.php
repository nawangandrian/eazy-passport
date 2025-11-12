<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Pemberitahuan</title>
    <style>
        @page { margin: 2cm; }
        body { font-family: "Times New Roman", serif; font-size: 12pt; }

        /* ==== KOP SURAT ==== */
        .kop-container {
            width: 100%;
            text-align: center;
            position: relative;
        }
        .kop-table {
            width: 100%;
            border-collapse: collapse;
        }
        .kop-table td {
            vertical-align: top; /* sebelumnya middle */
        }
        .logo {
            width: 65px;
            height: 65px;
            display: block; /* memastikan margin atas bisa dikontrol */
            margin-top: 0;  /* hapus margin atas default */
        }

        .judul {
            font-size: 14pt;
            font-weight: bold;
            line-height: 1.3;
        }
        .alamat {
            font-size: 11pt;
            line-height: 1.3;
        }
        .garis {
            border: 1px solid black;
            margin-top: 4px;
        }

        /* ==== META SURAT ==== */
        .meta-surat {
            width: 100%;
            border-collapse: collapse;
            margin-top: -15px;
        }
        .meta-surat td {
            padding: 2px 4px;
            vertical-align: top;
        }
        .meta-surat td:first-child { width: 20%; }
        .meta-surat td:nth-child(2) { width: 2%; }
        .tanggal-kanan { text-align: right; padding-bottom: 15px; }

        /* ==== ISI SURAT ==== */
        .isi-surat {
            margin-top: 25px;
            line-height: 1.5;
            text-align: justify;
        }
        .indent { text-indent: 1cm; }
        .detail-surat {
            margin-left: 1.5cm;
        }
        .detail-surat td:first-child { width: 2cm; }
        .detail-surat td:nth-child(2) { width: 0.5cm; }

        /* ==== TANDA TANGAN ==== */
        .ttd { margin-top: 20px; text-align: right; }
    </style>
</head>
<body>
    <!-- KOP SURAT -->
    <div class="kop-container">
        <table class="kop-table">
            <tr>
                <td width="15%" align="left">
                    <img src="{{ public_path('img/logo-imigrasi.png') }}" class="logo">
                </td>
                <td width="70%" align="center">
                    <div class="judul">PEMERINTAH KABUPATEN PATI</div>
                    <div class="judul">KANTOR IMIGRASI KELAS I NON TPI PATI</div>
                    <div class="alamat">
                        Jl. Raya Pati-Kudus Km.7 No.1 Kec. Margorejo, Lumpur, Bumirejo,<br>
                        Kec. Pati, Kabupaten Pati, Jawa Tengah 59163<br>
                        Telp: +62 812 5703 8946 | Email: info@imigrasipati.id
                    </div>
                </td>
                <td width="15%" align="right">
                    <img src="{{ public_path('img/logo-tpi.png') }}" class="logo">
                </td>
            </tr>
        </table>
        <hr class="garis">
    </div>

    <!-- Tanggal di atas nomor surat -->
    <p class="tanggal-kanan">Pati, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>

    <!-- BAGIAN META SURAT (Nomor, Lampiran, Perihal) -->
    <table class="meta-surat">
        <tr>
            <td><strong>Nomor</strong></td>
            <td>:</td>
            <td>{{ $nomor_surat }}</td>
        </tr>
        <tr>
            <td><strong>Lampiran</strong></td>
            <td>:</td>
            <td>-</td>
        </tr>
        <tr>
            <td><strong>Perihal</strong></td>
            <td>:</td>
            <td><strong>Pemberitahuan Jadwal Layanan</strong></td>
        </tr>
    </table>

    <!-- ISI SURAT -->
    <div class="isi-surat">
        <p style="margin-top: 10px;">
            Kepada Yth.<br>
            <strong>PERWAKILAN PEMOHON</strong><br>
            {{ $pembuat->email }}<br>
            Di tempat
        </p>

        <p style="margin-top: 20px;">
            Dengan hormat,
        </p>

        <p class="indent">
            Sehubungan dengan jadwal layanan <strong>Eazy Passport</strong> yang telah ditetapkan, bersama ini kami memberitahukan bahwa pelayanan akan dilaksanakan pada:
        </p>

        <!-- Detail jadwal tanpa bullet -->
        <table class="detail-surat">
            <tr>
                <td style="width: 2cm;">Tanggal</td>
                <td style="width: 0.5cm;">:</td>
                <td>{{ \Carbon\Carbon::parse($jadwal->tanggal_mulai)->format('d F Y') }}</td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }}
                -
                {{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }}
                WIB</td>
            </tr>
            <tr>
                <td>Lokasi</td>
                <td>:</td>
                <td>Kantor Imigrasi Pati</td>
            </tr>
        </table>

        <p class="indent" style="margin-top: 15px;">
            Diharapkan kepada perwakilan pemohon agar hadir tepat waktu dan membawa seluruh dokumen yang diperlukan
                                    sesuai ketentuan yang berlaku.
        </p>

        <p class="indent" style="margin-top: 15px;">
            Demikian agar dapat diperhatikan, dan mohon seluruh dokumen yang diperlukan sesuai ketentuan dibawa saat pelayanan berlangsung.
        </p>

        <div class="ttd">
            <p>Pati, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p>{{ $jabatan_kepala }}</p>
            <br><br>
            <p><strong><u>{{ $nama_kepala }}</u></strong></p>
        </div>
    </div>
</body>
</html>
