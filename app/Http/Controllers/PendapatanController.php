<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Pengajuan;
use App\Models\Pendapatan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PendapatanController extends Controller
{
    public function index(Request $request)
    {
        // Baca parameter filter dan tanggal dari request
        $filter = $request->input('filter', 'daily');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Jika tanggal belum di-set, atur default berdasarkan filter
        if (!$start_date || !$end_date) {
            if ($filter == 'daily') {
                $start_date = Carbon::today()->toDateString();
                $end_date = Carbon::today()->toDateString();
            } elseif ($filter == 'weekly') {
                $start_date = Carbon::now()->startOfWeek()->toDateString();
                $end_date = Carbon::now()->endOfWeek()->toDateString();
            } elseif ($filter == 'monthly') {
                $start_date = Carbon::now()->startOfMonth()->toDateString();
                $end_date = Carbon::now()->endOfMonth()->toDateString();
            } elseif ($filter == 'yearly') {
                $start_date = Carbon::now()->startOfYear()->toDateString();
                $end_date = Carbon::now()->endOfYear()->toDateString();
            }
        }

        // Query dengan filter berdasarkan rentang tanggal pada field p.created_at
        $results = DB::table('layanans as l')
            ->leftJoin('pengajuans as p', function($join) use ($start_date, $end_date) {
                $join->on('l.id', '=', 'p.layanan_id')
                     ->where('p.status_pembayaran', '=', 'lunas')
                     ->whereBetween(DB::raw('DATE(p.created_at)'), [$start_date, $end_date]);
            })
            ->leftJoin('pendapatan as pd', function($join) {
                $join->on('p.id', '=', 'pd.pengajuan_id');
            })
            ->select(
                'l.id',
                'l.nama_layanan',
                'l.harga_modal',
                'l.harga_jual',
                DB::raw('COUNT(DISTINCT p.id) as jumlah_transaksi'),
                DB::raw('SUM(pd.total_pendapatan) as total_pendapatan')
            )
            ->groupBy('l.id', 'l.nama_layanan', 'l.harga_modal', 'l.harga_jual')
            ->having(DB::raw('COUNT(DISTINCT p.id)'), '>', 0)
            ->get();

        $pendapatanData = [];
        $grandTotalModal = 0;
        $grandTotalJual = 0;
        $grandTotalKeuntungan = 0;
        $totalPengajuan = 0;

        foreach ($results as $result) {
            $jumlahTransaksi = $result->jumlah_transaksi;
            // Jika total_pendapatan NULL, gunakan harga_jual × jumlah transaksi
            $totalJual = $result->total_pendapatan ?? ($result->harga_jual * $jumlahTransaksi);
            $totalModal = $result->harga_modal * $jumlahTransaksi;
            $totalKeuntungan = $totalJual - $totalModal;

            $pendapatanData[] = [
                'layanan' => (object)[
                    'nama_layanan' => $result->nama_layanan
                ],
                'harga_modal' => $result->harga_modal,
                'harga_jual' => $result->harga_jual,
                'jumlah_transaksi' => $jumlahTransaksi,
                'total_modal' => $totalModal,
                'total_jual' => $totalJual,
                'total_keuntungan' => $totalKeuntungan
            ];

            $totalPengajuan += $jumlahTransaksi;
            $grandTotalModal += $totalModal;
            $grandTotalJual += $totalJual;
            $grandTotalKeuntungan += $totalKeuntungan;
        }

        return view('admin.pendapatan', [
            'pendapatan' => $pendapatanData,
            'totalPengajuan' => $totalPengajuan,
            'grandTotalModal' => $grandTotalModal,
            'grandTotalJual' => $grandTotalJual,
            'grandTotalKeuntungan' => $grandTotalKeuntungan,
            'filter' => $filter,
            'start_date' => $start_date,
            'end_date' => $end_date
        ]);
    }
}
