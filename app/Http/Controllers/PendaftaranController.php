<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;

class PendaftaranController extends Controller
{
    /**
     * Tampilkan daftar pendaftaran (PIC & PETUGAS)
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        // Jika role PETUGAS → lihat semua data
        if ($user->role === 'PETUGAS') {
            $query = Pendaftaran::with('user')->latest();
        } 
        // Jika role PIC → hanya lihat miliknya
        else {
            $query = Pendaftaran::where('user_id', $user->user_id)->latest();
        }

        // Fitur search
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('lokasi_layanan', 'like', "%{$search}%")
                  ->orWhere('jenis_layanan', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($u) use ($search) {
                      $u->where('nama_lengkap', 'like', "%{$search}%");
                  });
            });
        }

        // Pagination
        $pendaftarans = $query->paginate(10);
        $pendaftarans->appends(['search' => $search]);

        return view('pendaftaran.index', compact('pendaftarans', 'search'));
    }

    /**
     * Formulir pendaftaran baru
     */
    public function create()
    {
        return view('pendaftaran.create');
    }

    public function validasi(int $pendaftaran_id)
    {
        $pendaftaran = Pendaftaran::findOrFail($pendaftaran_id);

        $pendaftaran->status_verifikasi = 'Valid';
        // $pendaftaran->tanggal_validasi = now(); // opsional jika ada kolomnya
        $pendaftaran->save();

        return redirect()->back()->with('success', '✅ Pendaftaran berhasil divalidasi.');
    }
    
    /**
     * Simpan data pendaftaran baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lokasi_layanan' => 'required|string|max:150',
            'jenis_layanan' => 'required|in:Baru atau Penggantian,Reguler atau Percepatan',
        ]);

        Pendaftaran::create([
            'user_id' => Auth::id(),
            'lokasi_layanan' => $validated['lokasi_layanan'],
            'jenis_layanan' => $validated['jenis_layanan'],
            'tanggal_pengajuan' => now(),
            'status_verifikasi' => 'Menunggu',
            'jumlah_pemohon' => 0,
        ]);

        return redirect()->route('pendaftaran.index')
                         ->with('success', '✅ Pendaftaran berhasil dibuat!');
    }
}
