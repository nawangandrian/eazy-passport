<?php

namespace App\Http\Controllers;

use App\Models\RencanaJadwal;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RencanaJadwalController extends Controller
{
    // Daftar Jadwal (Petugas / Kepala Kantor)
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = RencanaJadwal::with(['pendaftaran', 'petugas']);

        if ($search) {
            $query->whereHas('pendaftaran.user', function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%");
            })
                ->orWhereHas('pendaftaran', function ($q) use ($search) {
                    $q->where('lokasi_layanan', 'like', "%{$search}%");
                });
        }

        $jadwals = $query->latest()->paginate(10);

        return view('jadwal.index', compact('jadwals', 'search'));
    }

    // Form buat jadwal
    public function create()
    {
        // Ambil pendaftaran yang sudah dijadwal
        $jadwalIds = RencanaJadwal::pluck('pendaftaran_id')->toArray();

        // Ambil pendaftar yang status verifikasi valid dan belum dijadwal
        $pendaftarans = Pendaftaran::with('user')
            ->where('status_verifikasi', 'Valid')
            ->whereNotIn('pendaftaran_id', $jadwalIds)
            ->get();

        return view('jadwal.create', compact('pendaftarans'));
    }

    public function edit(RencanaJadwal $jadwal)
    {
        $jadwal->load('pendaftaran.user');

        // Ambil semua pendaftar valid yang belum dijadwal kecuali pendaftar yang sedang diedit
        $jadwalIds = RencanaJadwal::where('pendaftaran_id', '!=', $jadwal->pendaftaran_id)
            ->pluck('pendaftaran_id')->toArray();

        $pendaftarans = Pendaftaran::with('user')
            ->where('status_verifikasi', 'Valid')
            ->whereNotIn('pendaftaran_id', $jadwalIds)
            ->get();

        return view('jadwal.create', compact('jadwal', 'pendaftarans'));
    }

    // Simpan jadwal baru
    public function store(Request $request)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran,pendaftaran_id',
            'tanggal_pelayanan' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'lokasi_pelayanan' => 'required|string|max:150',
        ]);

        RencanaJadwal::create([
            'pendaftaran_id' => $request->pendaftaran_id,
            'tanggal_pelayanan' => $request->tanggal_pelayanan,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'lokasi_pelayanan' => $request->lokasi_pelayanan,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Rencana jadwal berhasil dibuat.');
    }

    public function update(Request $request, RencanaJadwal $jadwal)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran,pendaftaran_id',
            'tanggal_pelayanan' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'lokasi_pelayanan' => 'required|string|max:150',
            'status_jadwal' => 'nullable|in:Menunggu Persetujuan,Disetujui,Ditolak,Revisi',
            'catatan_kepala' => 'nullable|string',
        ]);

        $jadwal->update([
            'pendaftaran_id' => $request->pendaftaran_id,
            'tanggal_pelayanan' => $request->tanggal_pelayanan,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'lokasi_pelayanan' => $request->lokasi_pelayanan,
            'status_jadwal' => $request->status_jadwal ?? $jadwal->status_jadwal,
            'catatan_kepala' => $request->catatan_kepala ?? $jadwal->catatan_kepala,
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Data jadwal berhasil diperbarui.');
    }

    // Hapus
    public function destroy(RencanaJadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    public function tinjau(Request $request)
    {
        $status = $request->query('status');
        $tanggalMulai = $request->query('tanggal_mulai');
        $tanggalAkhir = $request->query('tanggal_akhir');

        $jadwals = RencanaJadwal::with(['pendaftaran', 'petugas'])
            ->when($status, function ($query, $status) {
                $query->where('status_jadwal', $status);
            })
            ->when($tanggalMulai, function ($query, $tanggalMulai) {
                $query->where('tanggal_pelayanan', '>=', $tanggalMulai);
            })
            ->when($tanggalAkhir, function ($query, $tanggalAkhir) {
                $query->where('tanggal_pelayanan', '<=', $tanggalAkhir);
            })
            ->orderBy('tanggal_pelayanan', 'asc')
            ->paginate(10)
            ->appends($request->only(['status', 'tanggal_mulai', 'tanggal_akhir']));

        return view('kepala.jadwal.index', compact('jadwals', 'status', 'tanggalMulai', 'tanggalAkhir'));
    }

    // Update status jadwal (Setujui/Tolak/Revisi)
    public function updateStatus(Request $request, RencanaJadwal $jadwal)
    {
        $request->validate([
            'status_jadwal' => 'required|in:Disetujui,Ditolak,Revisi',
            'catatan_kepala' => 'nullable|string|max:500',
        ]);

        $jadwal->update([
            'status_jadwal' => $request->status_jadwal,
            'catatan_kepala' => $request->catatan_kepala,
        ]);

        return redirect()->route('kepala.jadwal.index')
            ->with('success', "Status jadwal berhasil diubah menjadi {$request->status_jadwal}");
    }
}
