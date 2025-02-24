@extends('admin.layout')

@section('content')
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Daftar Pengajuan</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola semua pengajuan layanan</p>
            </div>
            <a href="{{ route('pengajuan.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>
                <span>Tambah Pengajuan</span>
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Search and Filters -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6">
    <form action="{{ route('pengajuan.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Search Input -->
        <div class="col-span-1 md:col-span-2">
            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Pemohon</label>
            <div class="relative">
                <input type="text" 
                       name="search" 
                       id="search" 
                       value="{{ request('search') }}"
                       placeholder="Cari nama pemohon..."
                       class="block w-full pr-10 pl-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>
        </div>

        <!-- Status Filter -->
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" 
                    id="status" 
                    class="block w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                <option value="ready" {{ request('status') == 'ready' ? 'selected' : '' }}>Ready</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

        <!-- Layanan Filter -->
        <div>
            <label for="layanan" class="block text-sm font-medium text-gray-700 mb-1">Jenis Layanan</label>
            <select name="layanan" 
                    id="layanan" 
                    class="block w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                <option value="">Semua Layanan</option>
                @foreach($layanans as $layanan)
                    <option value="{{ $layanan->id }}" {{ request('layanan') == $layanan->id ? 'selected' : '' }}>
                        {{ $layanan->nama_layanan }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>
</div>
{{-- INI TABLE --}}
<div id="resultsContainer">
    @include('admin.pengajuan.partials.table')
</div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.querySelector('form');
    const searchInput = document.querySelector('#search');
    const statusSelect = document.querySelector('#status');
    const layananSelect = document.querySelector('#layanan');
    const resultsContainer = document.querySelector('#resultsContainer');

    // Fungsi untuk membuat loading indicator
    function createLoadingIndicator() {
        const div = document.createElement('div');
        div.className = 'flex justify-center items-center p-4';
        div.innerHTML = `
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
        `;
        return div;
    }

    // Fungsi untuk memperbarui hasil
    async function updateResults() {
        const loadingIndicator = createLoadingIndicator();
        resultsContainer.prepend(loadingIndicator);

        try {
            // Dapatkan semua parameter filter
            const searchValue = searchInput.value.trim();
            const statusValue = statusSelect.value;
            const layananValue = layananSelect.value;

            const params = new URLSearchParams();

            // Buat URL dengan parameter
            if (searchValue) params.append('search', searchValue);
            if (statusValue) params.append('status', statusValue);
            if (layananValue) params.append('layanan', layananValue);

            const url = window.location.pathname + (params.toString() ? `?${params.toString()}` : '');

            // Lakukan request
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) throw new Error('Network response was not ok');

            const html = await response.text();
            resultsContainer.innerHTML = html;

            // Update URL browser tanpa reload
            window.history.pushState({}, '', url);

        } catch (error) {
            console.error('Error:', error);
            resultsContainer.innerHTML = `
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg">
                    Terjadi kesalahan saat memuat data. Silakan coba lagi.
                </div>
            `;
        } finally {
            const loadingElement = resultsContainer.querySelector('.animate-spin')?.parentNode;
            if (loadingElement) {
                loadingElement.remove();
            }
        }
    }

    // Debounce function untuk search
    let debounceTimeout;
    function debounceSearch(func, wait) {
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(func, wait);
    }

    // Event listeners untuk filter
    searchInput.addEventListener('input', () => {
        debounceSearch(updateResults, 500);
    });

    statusSelect.addEventListener('change', updateResults);
    layananSelect.addEventListener('change', updateResults);

    // Handle form submission untuk status update
    document.addEventListener('change', function(e) {
        if (e.target.matches('select[name="status"]')) {
            const form = e.target.closest('form');
            if (!form) return;
            form.submit();
        }
    });

    // Handle form submission untuk status pembayaran
    document.addEventListener('change', function(e) {
        if (e.target.matches('select[name="status_pembayaran"]')) {
            const form = e.target.closest('form');
            if (!form) return;
            form.submit();
        }
    });
});

// Fungsi untuk konfirmasi delete
function confirmDelete(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data yang dihapus tidak dapat dikembalikan",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            event.target.submit();
        }
    });
}

// Fungsi untuk menampilkan modal dokumen
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
                const ext = dok.file_path.split('.').pop().toLowerCase();
                const isPdf = ext === 'pdf';
                
                container.innerHTML += `
                    <div class="border rounded-lg p-4 bg-white shadow-sm hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center mb-2">
                            <i class="fas ${isPdf ? 'fa-file-pdf text-red-500' : 'fa-file-image text-blue-500'} mr-2"></i>
                            <div class="font-medium truncate">${dok.nama_dokumen}</div>
                        </div>
                        ${isPdf ? 
                            `<embed src="${dok.file_path}" type="application/pdf" width="100%" height="200px" class="rounded border">` :
                            `<img src="${dok.file_path}" alt="${dok.nama_dokumen}" class="w-full h-48 object-cover rounded border">`
                        }
                        <a href="${dok.file_path}" 
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

// Fungsi untuk menutup modal
function closeModal() {
    const modal = document.getElementById('dokumentModal');
    modal.classList.add('hidden');
}

// Tambahkan event listener untuk menutup modal ketika mengklik di luar modal
document.getElementById('dokumentModal').addEventListener('click', function(event) {
    if (event.target === this) {
        closeModal();
    }
});
    
</script>
@endsection