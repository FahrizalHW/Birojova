<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;

class AdminController extends Controller
{
    public function index()
    {
    $pengajuanTerbaru = Pengajuan::with('layanan')
    ->orderBy('created_at', 'desc')
    ->take(5)
    ->get();
    
    $pengajuans = Pengajuan::all();
        
    return view('admin.dashboard', [
        'totalPengajuan' => $pengajuans->count(),
        'pending' => $pengajuans->where('status', 'pending')->count(),
        'proses' => $pengajuans->where('status', 'proses')->count(),
        'ready' => $pengajuans->where('status', 'ready')->count(),
        'ditolak' => $pengajuans->where('status', 'ditolak')->count(),
        'pengajuanData' => $pengajuans,
        'pengajuanTerbaru' => $pengajuanTerbaru,
    ]);
    }
}
