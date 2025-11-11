<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemohon extends Model
{
    use HasFactory;
    protected $table = 'pemohon';
    protected $primaryKey = 'pemohon_id';

    protected $fillable = [
        'pendaftaran_id',
        'nama_lengkap',
        'nik',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'no_paspor_lama',
        'status_data',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }

    public function dokumens()
    {
        return $this->hasMany(Dokumen::class, 'pemohon_id');
    }

}
