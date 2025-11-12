<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Surat Pelayanan</title>
    <style>
        /* Font dan layout umum */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 20px;
        }

        header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        header img {
            width: 60px;
            margin-right: 15px;
        }

        header div {
            flex: 1;
            text-align: center;
        }

        h1 {
            margin: 0;
            font-size: 18px;
            color: #1a202c;
        }

        h2 {
            margin: 5px 0 0 0;
            font-size: 14px;
            color: #555;
        }

        .date-print {
            text-align: right;
            font-size: 10px;
            color: #666;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px 10px;
            text-align: left;
        }

        th {
            background-color: #4a90e2;
            color: #fff;
            font-weight: 600;
            text-transform: uppercase;
        }

        tbody tr:nth-child(even) {
            background-color: #f7f9fc;
        }

        tbody tr:hover {
            background-color: #e6f2ff;
        }

        td {
            vertical-align: middle;
        }

        tfoot td {
            border: none;
            font-size: 10px;
            color: #666;
            padding-top: 15px;
        }

        @page {
            size: A4 landscape;
            margin: 20px;
        }
    </style>
</head>
<body>

    <!-- Header Logo & Judul -->
    <header>
        <img src="{{ public_path('img/logo.png') }}" alt="Logo Kantor">
        <div>
            <h1>Daftar Surat Jadwal Pelayanan yang Ditetujui</h1>
            <h2>KANTOR IMIGRASI KELAS I NON TPI PATI</h2>
        </div>
    </header>

    <!-- Tanggal Cetak -->
    <div class="date-print">
        Dicetak: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}
    </div>

    <table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Surat</th>
            <th>Jadwal</th>
            <th>PIC</th>
            <th>Jumlah Pemohon</th>
            <th>Lokasi Pelayanan</th>
            <th>Petugas</th>
            <th>Tanggal Terbit</th>
        </tr>
    </thead>
    <tbody>
        @if($surats->count() > 0)
            @foreach($surats as $i => $surat)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $surat->nomor_surat }}</td>
                    <td>{{ $surat->jadwal ? \Carbon\Carbon::parse($surat->jadwal->tanggal_pelayanan)->format('d-m-Y') : '-' }}</td>
                    <td>{{ $surat->penerima->nama_lengkap ?? '-' }}</td>
                    <td style="text-align:center">{{ $surat->jadwal ? $surat->jadwal->pendaftaran->count() : 0 }}</td>
                    <td>{{ $surat->jadwal->lokasi_pelayanan ?? '-' }}</td>
                    <td>{{ $surat->jadwal->petugas->nama_lengkap ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($surat->tanggal_terbit)->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8" style="text-align:center; color:#999; padding:20px;">
                    Tidak ada data surat untuk ditampilkan
                </td>
            </tr>
        @endif
    </tbody>
</table>

<!-- Footer bisa di luar table -->
<p style="margin-top:10px; font-size:10px; color:#666;">
    Jumlah data: {{ $surats->count() }} | Dokumen ini dicetak secara otomatis oleh sistem
</p>


</body>
</html>
