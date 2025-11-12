<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';
    protected $primaryKey = 'pendaftaran_id';

    protected $fillable = [
        'user_id',
        'lokasi_layanan',
        'jenis_layanan',
        'tanggal_pengajuan',
        'status_verifikasi',
        'catatan_verifikasi',
        'jumlah_pemohon',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pemohons()
    {
        return $this->hasMany(Pemohon::class, 'pendaftaran_id');
    }
}
