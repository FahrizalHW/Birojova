<?php

namespace App\Http\Controllers;
use App\Models\Pengajuan;
use App\Models\Layanan;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use App\Exports\PengajuanExport;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PengajuanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengajuan::with('layanan');

        if ($request->filled('search')) {
            $query->where('nama_pemohon', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('layanan')) {
            $query->where('layanan_id', $request->layanan);
        }

        $pengajuans = $query->latest()->get();
        
        if ($request->ajax()) {

            $layananName = null;
            if ($request->filled('layanan')) {
            $layananName = Layanan::find($request->layanan)?->nama_layanan;
        }
            return view('admin.pengajuan.partials.table', compact('pengajuans'))->render();
        }
        
        $layanans = Layanan::all();
        return view('admin.pengajuan.index', compact('pengajuans', 'layanans'));
    }

    public function create()
    {
        $layanans = Layanan::all();
        return view('admin.pengajuan.create', compact('layanans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemohon' => 'required',
            'nomor_hp' => 'required',
            'email' => 'required|email',
            'layanan_id' => 'required|exists:layanans,id',
            'dokumen.*.nama' => 'required',
            'dokumen.*.file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        $pengajuan = Pengajuan::create([
            'nama_pemohon' => $request->nama_pemohon,
            'nomor_hp' => $request->nomor_hp,
            'email' => $request->email,
            'layanan_id' => $request->layanan_id,
            'status' => 'pending',
            'status_pembayaran' => 'belum bayar',
        ]);

        if ($request->has('dokumen')) {
            foreach ($request->dokumen as $dok) {
                $path = $dok['file']->store('dokumen-pendukung', 'public');
                
                $pengajuan->dokumen()->create([  // Perhatikan perubahan dari dokumens() menjadi dokumen()
                    'nama_dokumen' => $dok['nama'],
                    'file_path' => $path
                ]);
            }
        }

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pengajuan = Pengajuan::with('dokumen')->findOrFail($id);
        $layanans = Layanan::all();
        
        return view('admin.pengajuan.edit', compact('pengajuan', 'layanans'));
    }

    public function update(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        
        // Update basic pengajuan info
        $pengajuan->update([
            'nama_pemohon' => $request->nama_pemohon,
            'nomor_hp' => $request->nomor_hp,
            'email' => $request->email,
            'layanan_id' => $request->layanan_id,
        ]);
        
        // Process existing documents one by one
        if ($request->has('existing_dokumen')) {
            foreach ($request->existing_dokumen as $index => $docData) {
                // Only process if we have a valid document ID
                if (!isset($docData['id'])) continue;
                
                $dokumen = Dokumen::find($docData['id']);
                if (!$dokumen) continue;

                // Handle deletion if requested
                if (isset($docData['delete']) && $docData['delete']) {
                    if ($dokumen->file_path && Storage::exists($dokumen->file_path)) {
                        Storage::delete($dokumen->file_path);
                    }
                    $dokumen->delete();
                    continue;
                }
                
                // Update document name if provided
                if (isset($docData['nama'])) {
                    $dokumen->nama_dokumen = $docData['nama'];
                }
                
                // Handle file update if a new file was uploaded
                if (isset($docData['file']) && $docData['file'] instanceof \Illuminate\Http\UploadedFile) {
                    // Remove old file
                    if ($dokumen->file_path && Storage::exists($dokumen->file_path)) {
                        Storage::delete($dokumen->file_path);
                    }
                    
                    // Save new file
                    $path = $docData['file']->store('dokumen-pendukung');
                    $dokumen->file_path = $path;
                    if(empty($docData['nama'])){
                        $dokumen->nama_dokumen = $docData['file']->getClientOriginalName();
                    }
                }
                
                // Save changes to this document
                $dokumen->save();
            }
        }
        
        // Process new documents
        if ($request->has('new_dokumen')) {
            foreach ($request->new_dokumen as $newDoc) {
                if (isset($newDoc['file']) && $newDoc['file'] instanceof \Illuminate\Http\UploadedFile && isset($newDoc['nama'])) {
                    $path = $newDoc['file']->store('dokumen-pendukung');
                    
                    Dokumen::create([
                        'pengajuan_id' => $pengajuan->id,
                        'nama_dokumen' => $newDoc['nama'],
                        'file_path' => $path
                    ]);
                }
            }
        }
        
        return redirect()->route('pengajuan.index')
                    ->with('success', 'Pengajuan berhasil diperbarui');
    }

    public function updateStatus(Request $request, Pengajuan $pengajuan)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,ready,ditolak',
        ]);

        $pengajuan->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }

    public function destroy(Pengajuan $pengajuan)
    {
        $pengajuan->delete();
        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil dihapus.');
    }

    public function export()
    {
        return Excel::download(new PengajuanExport, 'pengajuans.xlsx');
    }

    public function getByStatus($status)
    {
        $pengajuans = Pengajuan::with('layanan')
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return response()->json($pengajuans);
    }

    public function updateStatusBayar(Request $request, Pengajuan $pengajuan)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:lunas,belum bayar',
        ]);    

        $pengajuan->update([
            'status_pembayaran' => $request->status_pembayaran
        ]);

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }

    public function getByStatusbayar($status_pembayaran)
    {
        $pengajuans = Pengajuan::with('layanan')
            ->where('status_pembayaran', $status_pembayaran)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return response()->json($pengajuans);
    }

    public function getDokumen(Pengajuan $pengajuan)
    {
        $dokumen = $pengajuan->dokumen()->get()->map(function($dok) {
            return [
                'nama_dokumen' => $dok->nama_dokumen,
                'file_path' => asset('storage/' . $dok->file_path)
            ];
        });
        
        return response()->json($dokumen);
    }

}




    