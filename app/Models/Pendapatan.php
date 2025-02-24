<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendapatan extends Model
{
    protected $table = 'pendapatan';

    protected $fillable = [
        'layanan_id',
        'total_pendapatan',
    ];

    protected $casts = [
        'total_pendapatan' => 'decimal:2',
    ];

    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class);
    }

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'layanan_id', 'layanan_id');
    }

    public function pengajuanLangsung(): BelongsTo
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }
}
