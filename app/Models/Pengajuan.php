<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuans';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_pemohon',
        'nomor_hp',
        'email',
        'layanan_id',
        'status',
        'status_pembayaran',
    ];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    public function dokumen()  
    {
        return $this->hasMany(Dokumen::class);
    }
}
