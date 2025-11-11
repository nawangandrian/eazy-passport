<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Pemohon;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PemohonController extends Controller
{
    /**
     * Tampilkan daftar pemohon per pendaftaran, dengan search & pagination
     */
    public function index(Request $request, $pendaftaran_id)
    {
        $pendaftaran = Pendaftaran::findOrFail($pendaftaran_id);

        // Ambil query search
        $search = $request->input('search');

        $query = $pendaftaran->pemohons();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        $pemohons = $query->latest()->paginate(10); // ganti 5 sesuai kebutuhan
        $pemohons->appends(['search' => $search]); 

        return view('pemohon.index', compact('pendaftaran', 'pemohons'));
    }

    /**
     * Form tambah pemohon
     */
    public function create($pendaftaran_id)
    {
        $pendaftaran = Pendaftaran::findOrFail($pendaftaran_id);
        return view('pemohon.create', compact('pendaftaran'));
    }

    /**
     * Simpan pemohon baru
     */
    public function store(Request $request, $pendaftaran_id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'nik' => 'required|string|size:16',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:20',
            'no_paspor_lama' => 'nullable|string|max:20',
            'dokumen.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Simpan data pemohon
        $pemohon = Pemohon::create(array_merge($request->all(), [
            'pendaftaran_id' => $pendaftaran_id,
        ]));

        // Simpan dokumen jika ada
        if ($request->hasFile('dokumen')) {
            foreach ($request->file('dokumen') as $jenis => $file) {
                if ($file) {
                    $filePath = $file->store('dokumen', 'public');
                    Dokumen::create([
                        'pemohon_id' => $pemohon->pemohon_id,
                        'jenis_dokumen' => $jenis,
                        'file_path' => $filePath,
                        'tanggal_upload' => now(),
                    ]);
                }
            }
        }

        // Update jumlah pemohon di pendaftaran
        $pendaftaran = Pendaftaran::findOrFail($pendaftaran_id);
        $pendaftaran->jumlah_pemohon = $pendaftaran->pemohons()->count();
        $pendaftaran->save();

        return redirect()->route('pemohon.index', $pendaftaran_id)
                         ->with('success', 'Data pemohon berhasil ditambahkan.');
    }

    public function edit($pendaftaran_id, Pemohon $pemohon)
    {
        $pendaftaran = Pendaftaran::findOrFail($pendaftaran_id);
        return view('pemohon.edit', compact('pendaftaran', 'pemohon'));
    }

    // Update Pemohon
    public function update(Request $request, $pendaftaran_id, Pemohon $pemohon)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'nik' => 'required|string|size:16',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:20',
            'no_paspor_lama' => 'nullable|string|max:20',
            'dokumen.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Update data pemohon
        $pemohon->update($request->all());

        // Update dokumen
        if ($request->hasFile('dokumen')) {
            foreach ($request->file('dokumen') as $jenis => $file) {
                if ($file) {
                    // Hapus file lama jika ada
                    $existing = $pemohon->dokumens()->where('jenis_dokumen', $jenis)->first();
                    if ($existing) {
                        if (Storage::disk('public')->exists($existing->file_path)) {
                            Storage::disk('public')->delete($existing->file_path);
                        }
                        $existing->delete();
                    }

                    // Simpan file baru
                    $filePath = $file->store('dokumen', 'public');
                    Dokumen::create([
                        'pemohon_id' => $pemohon->pemohon_id,
                        'jenis_dokumen' => $jenis,
                        'file_path' => $filePath,
                        'tanggal_upload' => now(),
                    ]);
                }
            }
        }

        // Update jumlah pemohon tetap sama
        $pendaftaran = Pendaftaran::findOrFail($pendaftaran_id);
        $pendaftaran->jumlah_pemohon = $pendaftaran->pemohons()->count();
        $pendaftaran->save();

        return redirect()->route('pemohon.index', $pendaftaran_id)
                        ->with('success', 'Data pemohon berhasil diperbarui.');
    }

    // Hapus Pemohon
    public function destroy($pendaftaran_id, Pemohon $pemohon)
    {
        // Hapus semua dokumen terkait file
        foreach ($pemohon->dokumens as $dokumen) {
            if (Storage::disk('public')->exists($dokumen->file_path)) {
                Storage::disk('public')->delete($dokumen->file_path);
            }
            $dokumen->delete();
        }

        $pemohon->delete();

        // Update jumlah pemohon
        $pendaftaran = Pendaftaran::findOrFail($pendaftaran_id);
        $pendaftaran->jumlah_pemohon = $pendaftaran->pemohons()->count();
        $pendaftaran->save();

        return redirect()->route('pemohon.index', $pendaftaran_id)
                        ->with('success', 'Data pemohon berhasil dihapus.');
    }
}
