<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPemberitahuan extends Model
{
    use HasFactory;

    protected $table = 'surat_pemberitahuan';
    protected $primaryKey = 'surat_id';
    protected $fillable = [
        'jadwal_id',
        'nomor_surat',
        'file_surat',
        'tanggal_terbit',
        'diterima_oleh'
    ];

    public function jadwal()
    {
        return $this->belongsTo(RencanaJadwal::class, 'jadwal_id', 'jadwal_id');
    }

    public function penerima()
    {
        return $this->belongsTo(User::class, 'diterima_oleh', 'user_id');
    }
}
