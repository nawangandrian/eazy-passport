<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $primaryKey = 'dokumen_id';
    protected $table = 'dokumen';
    protected $fillable = [
        'pemohon_id',
        'jenis_dokumen',
        'file_path',
        'tanggal_upload'
    ];

    public function pemohon()
    {
        return $this->belongsTo(Pemohon::class, 'pemohon_id');
    }
}
