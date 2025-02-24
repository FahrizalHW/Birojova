<?php

namespace App\Exports;

use App\Models\Pengajuan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PengajuanExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Pengajuan::join('layanans', 'pengajuans.layanan_id', '=', 'layanans.id')
            ->select(
                'pengajuans.id',
                'pengajuans.nama_pemohon',
                'pengajuans.nomor_hp',
                'pengajuans.email',
                'layanans.nama_layanan',
                'pengajuans.status'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID Pengajuan',
            'Nama Pemohon',
            'Nomor HP',
            'Email',
            'Nama Layanan',
            'Status'
        ];
    }

    public function map($pengajuan): array
    {
        return [
            $pengajuan->id,
            $pengajuan->nama_pemohon,
            $pengajuan->nomor_hp,
            $pengajuan->email,
            $pengajuan->nama_layanan,
            $pengajuan->status,
        ];
    }
}
