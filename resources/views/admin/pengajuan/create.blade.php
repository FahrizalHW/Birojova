@extends('admin.layout')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Tambah Pengajuan</h2>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            <div class="bg-gray-50 rounded-lg p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Nama Pemohon</label>
                        <input type="text" 
                               name="nama_pemohon" 
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm" 
                               required>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Nomor HP</label>
                        <input type="text" 
                               name="nomor_hp" 
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm" 
                               required>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" 
                               name="email" 
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm" 
                               required>
                    </div>
                    
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Jenis Layanan</label>
                        <select name="layanan_id" 
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            @foreach ($layanans as $layanan)
                                <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Dokumen Pendukung Section -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Dokumen Pendukung</h3>
                <div id="dokumenContainer" class="space-y-4">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-gray-700">Nama Dokumen</label>
                                <input type="text" 
                                       name="dokumen[0][nama]" 
                                       class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                       required>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-gray-700">File</label>
                                <input type="file" 
                                       name="dokumen[0][file]" 
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
                    </div>
                </div>
                
                <button type="button" 
                        onclick="tambahDokumen()"
                        class="mt-4 inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-plus mr-2"></i> Tambah Dokumen
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
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let dokumenCounter = 1;

function tambahDokumen() {
    const container = document.getElementById('dokumenContainer');
    const newDokumen = `
        <div class="bg-white rounded-lg shadow p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Nama Dokumen</label>
                    <input type="text" 
                           name="dokumen[${dokumenCounter}][nama]" 
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                           required>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">File</label>
                    <input type="file" 
                           name="dokumen[${dokumenCounter}][file]" 
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
                    onclick="this.parentElement.remove()" 
                    class="mt-4 inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                <i class="fas fa-trash mr-2"></i> Hapus
            </button>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', newDokumen);
    dokumenCounter++;
}
</script>
@endsection     