@extends('admin.layout')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Edit Pengajuan</h2>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pengajuan.update', $pengajuan->id) }}" method="POST" enctype="multipart/form-data" id="updatePengajuanForm" class="space-y-8">
            @csrf
            @method('PUT')
            <div class="bg-gray-50 rounded-lg p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Nama Pemohon</label>
                        <input type="text" 
                               name="nama_pemohon" 
                               value="{{ $pengajuan->nama_pemohon }}"
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm" 
                               required>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Nomor HP</label>
                        <input type="text" 
                               name="nomor_hp" 
                               value="{{ $pengajuan->nomor_hp }}"
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm" 
                               required>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" 
                               name="email" 
                               value="{{ $pengajuan->email }}"
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm" 
                               required>
                    </div>
                    
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Jenis Layanan</label>
                        <select name="layanan_id" 
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            @foreach ($layanans as $layanan)
                                <option value="{{ $layanan->id }}" {{ $pengajuan->layanan_id == $layanan->id ? 'selected' : '' }}>
                                    {{ $layanan->nama_layanan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Dokumen Pendukung Section -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Dokumen Pendukung</h3>
                
                <!-- Existing Documents Section -->
                <div class="space-y-4">
                    @foreach($pengajuan->dokumen as $index => $dokumen)
                    <div class="bg-white rounded-lg shadow p-6 dokumen-item">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-md font-semibold text-gray-900">Dokumen #{{ $index + 1 }}</h4>
                            <input type="hidden" name="existing_dokumen[{{ $index }}][id]" value="{{ $dokumen->id }}">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-gray-700">Nama Dokumen</label>
                                <input type="text" 
                                    name="existing_dokumen[{{ $index }}][nama]" 
                                    value="{{ $dokumen->nama_dokumen }}"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm" 
                                    required>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-gray-700">File Saat Ini</label>
                                <div class="flex items-center space-x-3 p-2 bg-gray-50 rounded-lg">
                                    <span class="text-sm text-gray-600">{{ $dokumen->nama_dokumen }}</span>
                                    @if(Storage::exists($dokumen->file_path))
                                    <a href="{{ url('storage/' . str_replace('public/', '', $dokumen->file_path)) }}" 
                                        target="_blank" 
                                        class="inline-flex items-center px-3 py-1 text-sm text-blue-700 bg-blue-50 rounded-full hover:bg-blue-100 transition-colors">
                                        <i class="fas fa-eye mr-1"></i> Lihat
                                    </a>                                
                                    @else
                                        <span class="px-3 py-1 text-sm text-red-600 bg-red-50 rounded-full">File tidak ditemukan</span>
                                    @endif
                                </div>
                                <div class="mt-3">
                                    <label class="text-sm font-semibold text-gray-700">Ganti File (Opsional)</label>
                                    <input type="file" 
                                        name="existing_dokumen[{{ $index }}][file]" 
                                        accept=".pdf,.jpg,.jpeg,.png"
                                        class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-900
                                                file:mr-4 file:py-2 file:px-4
                                                file:rounded-full file:border-0
                                                file:text-sm file:font-semibold
                                                file:bg-blue-100 file:text-blue-700
                                                hover:file:bg-blue-200
                                                cursor-pointer">
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" 
                                    name="existing_dokumen[{{ $index }}][delete]" 
                                    value="1"
                                    class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm font-medium text-red-600">Hapus dokumen ini</span>
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- New Documents Container -->
                <div class="mt-4 space-y-4" id="dokumenContainer">
                    <!-- New document fields will be added here -->
                </div>
                
                <button type="button" 
                        onclick="tambahDokumen()"
                        class="mt-4 inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <i class="fas fa-plus mr-2"></i> Tambah Dokumen Baru
                </button>
            </div>

            <div class="flex justify-end space-x-4 pt-6">
                <button type="button" 
                        onclick="history.back()" 
                        class="px-6 py-2.5 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <i class="fas fa-times mr-2"></i> Batal
                </button>
                <button type="submit" 
                        class="px-6 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let dokumenCounter = {{ count($pengajuan->dokumen ?? []) }};

function tambahDokumen() {
    const container = document.getElementById('dokumenContainer');
    const newDokumen = `
        <div class="bg-white rounded-lg shadow p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Nama Dokumen Baru</label>
                    <input type="text" 
                           name="new_dokumen[${dokumenCounter}][nama]" 
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm" 
                           required>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">File</label>
                    <input type="file" 
                           name="new_dokumen[${dokumenCounter}][file]" 
                           accept=".pdf,.jpg,.jpeg,.png"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-900
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-full file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-blue-100 file:text-blue-700
                                  hover:file:bg-blue-200
                                  cursor-pointer"
                           required>
                    <p class="mt-1 text-sm text-gray-500">PDF, JPG, atau PNG (Max. 2MB)</p>
                </div>
            </div>
            <button type="button" 
                    onclick="this.closest('.bg-white').remove()" 
                    class="mt-4 inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                <i class="fas fa-trash mr-2"></i> Hapus
            </button>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', newDokumen);
    dokumenCounter++;
}

document.querySelector('form').addEventListener('submit', function(e) {
    console.log('Form submitting...');
    
    const existingDocs = document.querySelectorAll('.dokumen-item');
    existingDocs.forEach((doc, index) => {
        const idInput = doc.querySelector('input[name^="existing_dokumen"][name$="[id]"]');
        const nameInput = doc.querySelector('input[name^="existing_dokumen"][name$="[nama]"]');
        const fileInput = doc.querySelector('input[name^="existing_dokumen"][name$="[file]"]');
        const deleteBox = doc.querySelector('input[name^="existing_dokumen"][name$="[delete]"]');
        
        console.log(`Doc #${index+1}:`);
        console.log(` - ID: ${idInput ? idInput.value : 'Missing ID input!'}`);
        console.log(` - Name: ${nameInput ? nameInput.value : 'Missing name input!'}`);
        console.log(` - Has file: ${fileInput && fileInput.files.length > 0 ? 'Yes' : 'No'}`);
        console.log(` - Delete checked: ${deleteBox && deleteBox.checked ? 'Yes' : 'No'}`);
    });
});
</script>
@endsection