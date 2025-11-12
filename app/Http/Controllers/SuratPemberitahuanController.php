<?php

namespace App\Http\Controllers;

use App\Models\SuratPemberitahuan;
use App\Models\RencanaJadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class SuratPemberitahuanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input filter
        $search = $request->query('search');
        $tanggalMulai = $request->query('tanggal_mulai');
        $tanggalAkhir = $request->query('tanggal_akhir');

        // Query surat dengan relasi
        $surats = SuratPemberitahuan::with(['jadwal.pendaftaran.user', 'penerima'])
            ->when($search, function ($query, $search) {
                $query->where('nomor_surat', 'like', "%$search%")
                    ->orWhereHas('penerima', function ($q) use ($search) {
                        $q->where('nama_lengkap', 'like', "%$search%");
                    });
            })
            ->when($tanggalMulai, function ($query, $tanggalMulai) {
                $query->whereDate('tanggal_terbit', '>=', $tanggalMulai);
            })
            ->when($tanggalAkhir, function ($query, $tanggalAkhir) {
                $query->whereDate('tanggal_terbit', '<=', $tanggalAkhir);
            })
            ->latest()
            ->paginate(10);

        $jadwal_disetujui = RencanaJadwal::where('status_jadwal', 'Disetujui')
            ->whereDoesntHave('surat') // pastikan belum ada surat
            ->orderBy('tanggal_pelayanan', 'asc') // urut dari tanggal paling dekat
            ->get();

        return view('surat.index', compact(
            'surats',
            'jadwal_disetujui',
            'search',
            'tanggalMulai',
            'tanggalAkhir'
        ));
    }

    public function preview(SuratPemberitahuan $surat)
    {
        $pdfPath = storage_path('app/private/' . $surat->file_surat);

        if (!file_exists($pdfPath)) {
            abort(404, 'File surat tidak ditemukan.');
        }

        return response()->file($pdfPath);
    }

    public function generatePdf(Request $request, RencanaJadwal $jadwal)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:50',
            'nama_kepala' => 'required|string|max:100',
            'jabatan_kepala' => 'required|string|max:150',
        ]);

        $pembuat = $jadwal->pendaftaran->user;

        $pdf = Pdf::loadView('surat.pdf', [
            'jadwal' => $jadwal,
            'pembuat' => $pembuat,
            'nomor_surat' => $request->nomor_surat,
            'nama_kepala' => $request->nama_kepala,
            'jabatan_kepala' => $request->jabatan_kepala,
        ]);

        $filename = 'Surat_Pemberitahuan_' . $jadwal->jadwal_id . '.pdf';
        return $pdf->stream($filename);
    }

    public function exportPdf(Request $request)
    {
        $query = SuratPemberitahuan::query()->with(['jadwal.pendaftaran.user', 'jadwal.petugas', 'penerima']);

        // Filter nomor surat / PIC
        if ($request->search) {
            $query->whereHas('penerima', function ($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->search . '%');
            })->orWhere('nomor_surat', 'like', '%' . $request->search . '%');
        }

        // Filter tanggal
        if ($request->tanggal_mulai) {
            $query->whereDate('tanggal_terbit', '>=', $request->tanggal_mulai);
        }
        if ($request->tanggal_akhir) {
            $query->whereDate('tanggal_terbit', '<=', $request->tanggal_akhir);
        }

        $surats = $query->get();

        // Ganti 'surat.pdf' menjadi 'surat.laporan' sesuai nama file view
        $pdf = PDF::loadView('surat.laporan', compact('surats'));

        return $pdf->stream('laporan_surat.pdf');
    }

    public function jadwalSaya()
    {
        $surats = SuratPemberitahuan::select('surat_pemberitahuan.*')
            ->join('rencana_jadwal as jadwal', 'surat_pemberitahuan.jadwal_id', '=', 'jadwal.jadwal_id')
            ->join('pendaftaran', 'jadwal.pendaftaran_id', '=', 'pendaftaran.pendaftaran_id')
            ->where('pendaftaran.user_id', Auth::id())
            ->with('jadwal.pendaftaran.user', 'penerima')
            ->orderByDesc('jadwal.tanggal_pelayanan')
            ->get();

        return view('surat.jadwal_saya', compact('surats'));
    }

    // Form buat surat baru
    public function create(RencanaJadwal $jadwal)
    {
        if ($jadwal->status_jadwal !== 'Disetujui') {
            return redirect()->route('surat.index')
                ->with('error', 'Surat hanya bisa dibuat untuk jadwal yang sudah disetujui Kepala Kantor.');
        }

        $pembuat = $jadwal->pendaftaran->user;

        return view('surat.create', compact('jadwal', 'pembuat'));
    }

    // Simpan surat
    public function store(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:rencana_jadwal,jadwal_id',
            'nomor_surat' => 'required|string|max:50',
            'file_surat' => 'required|file|mimes:pdf|max:2048',
            'diterima_oleh' => 'required|exists:users,user_id',
        ]);

        $jadwal = RencanaJadwal::findOrFail($request->jadwal_id);

        if ($jadwal->status_jadwal !== 'Disetujui') {
            return redirect()->route('surat.index')
                ->with('error', 'Tidak bisa membuat surat: jadwal belum disetujui.');
        }

        $filePath = $request->file('file_surat')->store('surat_pemberitahuan');

        SuratPemberitahuan::create([
            'jadwal_id' => $request->jadwal_id,
            'nomor_surat' => $request->nomor_surat,
            'file_surat' => $filePath,
            'tanggal_terbit' => Carbon::now(),
            'diterima_oleh' => $request->diterima_oleh,
        ]);

        return redirect()->route('surat.index')->with('success', 'Surat pemberitahuan berhasil dibuat.');
    }

    // Download surat
    public function download(SuratPemberitahuan $surat)
    {
        return Storage::download($surat->file_surat, $surat->nomor_surat . '.pdf');
    }
}
