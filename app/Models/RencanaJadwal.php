<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaJadwal extends Model
{
    use HasFactory;

    protected $table = 'rencana_jadwal';
    protected $primaryKey = 'jadwal_id';
    protected $casts = [
        'tanggal_pelayanan' => 'datetime', // pastikan ini sesuai nama kolom
    ];

    protected $fillable = [
        'pendaftaran_id',
        'tanggal_pelayanan',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi_pelayanan',
        'status_jadwal',
        'catatan_kepala',
        'created_by',
    ];

    // Relasi ke Pendaftaran
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id', 'pendaftaran_id');
    }

    public function surat()
    {
        return $this->hasOne(SuratPemberitahuan::class, 'jadwal_id', 'jadwal_id');
    }

    public function surats()
    {
        return $this->hasMany(SuratPemberitahuan::class, 'jadwal_id');
    }

    // Relasi ke User (Petugas)
    public function petugas()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }
}
