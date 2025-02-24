<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $fillable = ['pengajuan_id', 'nama_dokumen', 'file_path'];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    public function dokumens()
    {
        return $this->hasMany(Dokumen::class);
    }
}
