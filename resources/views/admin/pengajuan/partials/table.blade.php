<div class="overflow-x-auto">
    @if($pengajuans->isEmpty())
        <div class="text-center py-8">
            <div class="mb-2">
                <i class="fas fa-search text-gray-400 text-5xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-1">Data Tidak Ditemukan</h3>
            <p class="text-gray-500">
                @if(request('search'))
                    Tidak ada pengajuan dengan nama "{{ request('search') }}"
                @elseif(request('status'))
                    Tidak ada pengajuan dengan status "{{ request('status') }}"
                @elseif(request('layanan'))
                    Tidak ada pengajuan untuk layanan "{{ optional(Layanan::find(request('layanan')))->nama_layanan }}"
                @else
                    Tidak ada data pengajuan yang tersedia
                @endif
            </p>
        </div>
    @else
    <table class="min-w-full">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pemohon</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Layanan</th>
                <!-- Kolom Tanggal Pengajuan ditambahkan -->
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pengajuan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Pengajuan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dokumen</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Bayar</th>
                <th class="px-20 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengajuans as $pengajuan)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ $pengajuan->nama_pemohon }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ $pengajuan->nomor_hp }}</div>
                        <div class="text-sm text-gray-500">{{ $pengajuan->email }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ $pengajuan->layanan->nama_layanan }}</div>
                    </td>
                    <!-- Tampilkan Tanggal Pengajuan -->
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ $pengajuan->created_at->format('d-m-Y') }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('pengajuan.updateStatus', $pengajuan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" 
                                    onchange="this.form.submit()" 
                                    class="text-sm rounded-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                        @if($pengajuan->status == 'pending') text-yellow-800 bg-yellow-100 border-yellow-200
                                        @elseif($pengajuan->status == 'proses') text-blue-800 bg-blue-100 border-blue-200
                                        @elseif($pengajuan->status == 'ready') text-green-800 bg-green-100 border-green-200
                                        @else text-red-800 bg-red-100 border-red-200
                                        @endif">
                                <option value="pending" {{ $pengajuan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="proses" {{ $pengajuan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="ready" {{ $pengajuan->status == 'ready' ? 'selected' : '' }}>Ready</option>
                                <option value="ditolak" {{ $pengajuan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4">
                        <button onclick="showDokumen({{ $pengajuan->id }})" 
                                class="text-blue-600 hover:text-blue-800 font-medium">
                            View
                        </button>
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('pengajuan.updateStatusBayar', $pengajuan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status_pembayaran" 
                                    onchange="this.form.submit()"
                                    class="text-sm rounded-full px-3 py-1.5 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                        {{ $pengajuan->status_pembayaran == 'lunas' ? 'bg-green-100 text-green-800 border-green-200' : 'bg-red-100 text-red-800 border-red-200' }}">
                                <option value="belum bayar" {{ $pengajuan->status_pembayaran == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                                <option value="lunas" {{ $pengajuan->status_pembayaran == 'lunas' ? 'selected' : '' }}>Lunas</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('pengajuan.edit', $pengajuan->id) }}" 
                               class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors duration-200">
                                <i class="fas fa-edit mr-1.5"></i>
                                <span>Edit</span>
                            </a>
                            <form action="{{ route('pengajuan.destroy', $pengajuan->id) }}" 
                                method="POST" 
                                class="inline-block"
                                onsubmit="return confirmDelete(event)">
                              @csrf 
                              @method('DELETE')
                              <button type="submit" 
                                      class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-200">
                                  <i class="fas fa-trash-alt mr-1.5"></i>
                                  <span>Hapus</span>
                              </button>
                          </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>


<!-- Modal Dokumen - Tambahkan di bawah tabel -->
<div id="dokumentModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg w-full max-w-3xl max-h-[90vh] overflow-hidden">
        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-medium">Dokumen Pendukung</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-4 overflow-y-auto max-h-[calc(90vh-8rem)]">
            <div id="dokumenContainer" class="grid grid-cols-2 gap-4">
            </div>
        </div>
    </div>
</div>

<script>
    function showDokumen(pengajuanId) {
    const modal = document.getElementById('dokumentModal');
    const container = document.getElementById('dokumenContainer');
    
    // Tampilkan modal
    modal.classList.remove('hidden');
    
    // Tampilkan loading
    container.innerHTML = `
        <div class="col-span-2 flex justify-center items-center py-8">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
        </div>
    `;
    
    // Ambil data dokumen
    fetch(`/pengajuan/${pengajuanId}/dokumen`)
        .then(response => response.json())
        .then(data => {
            if (data.length === 0) {
                container.innerHTML = `
                    <div class="col-span-2 text-center py-8">
                        <div class="mb-2">
                            <i class="fas fa-file-alt text-gray-400 text-5xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak Ada Dokumen</h3>
                        <p class="text-gray-500">Belum ada dokumen yang diupload untuk pengajuan ini</p>
                    </div>
                `;
                return;
            }
            
            container.innerHTML = ''; // Clear loading
            
            // Render dokumen
            data.forEach(dok => {
                const fileUrl = dok.file_path;
                const ext = fileUrl.split('.').pop().toLowerCase();
                const isPdf = ext === 'pdf';
                
                container.innerHTML += `
                    <div class="border rounded-lg p-4 bg-white shadow-sm hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center mb-2">
                            <i class="fas ${isPdf ? 'fa-file-pdf text-red-500' : 'fa-file-image text-blue-500'} mr-2"></i>
                            <div class="font-medium truncate">${dok.nama_dokumen}</div>
                        </div>
                        <div class="relative h-48 w-full mb-2">
                            ${isPdf ? 
                                `<embed src="${fileUrl}" type="application/pdf" width="100%" height="100%" class="rounded border">` :
                                `<img src="${fileUrl}" alt="${dok.nama_dokumen}" class="w-full h-full object-contain rounded border">`
                            }
                        </div>
                        <a href="${fileUrl}" 
                           target="_blank" 
                           class="mt-2 inline-flex items-center text-sm text-blue-600 hover:text-blue-800">
                            <i class="fas fa-external-link-alt mr-1"></i>
                            Buka di Tab Baru
                        </a>
                    </div>
                `;
            });
        })
        .catch(error => {
            console.error('Error:', error);
            container.innerHTML = `
                <div class="col-span-2 text-center py-8">
                    <div class="mb-2">
                        <i class="fas fa-exclamation-circle text-red-500 text-5xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Terjadi Kesalahan</h3>
                    <p class="text-gray-500">Gagal memuat dokumen. Silakan coba lagi.</p>
                </div>
            `;
        });
}

    
</script>