<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Pengajuan; 

class PDFController extends Controller
{
    public function exportPDF()
    {
        $pengajuan = Pengajuan::with('layanan')->get(); 

        $pdf = Pdf::loadView('pdf.pengajuan', compact('pengajuan'));

        return $pdf->download('data-pengajuan.pdf');
    }
}
