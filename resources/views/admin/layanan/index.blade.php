@extends('admin.layout')

@section('content')
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Daftar Layanan</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola semua layanan yang tersedia</p>
            </div>
            <a href="{{ route('layanan.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>
                <span>Tambah Layanan</span>
            </a>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Layanan
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Deskripsi
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Harga Modal
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Harga Jual
                            </th>
                            <th class="px-20 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($layanans as $layanan)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $layanan->nama_layanan }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500 line-clamp-2">
                                        {{ $layanan->deskripsi }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    Rp{{ number_format($layanan->harga_modal, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    Rp{{ number_format($layanan->harga_jual, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-3">
                                        <a href="{{ route('layanan.edit', $layanan->id) }}" 
                                           class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors duration-200">
                                            <i class="fas fa-edit mr-1.5"></i>
                                            <span>Edit</span>
                                        </a>
                                        <form action="{{ route('layanan.destroy', $layanan->id) }}" 
                                              method="POST" 
                                              class="inline-block"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')">
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
            </div>

            <!-- Empty State -->
            @if($layanans->isEmpty())
                <div class="text-center py-12">
                    <div class="text-gray-400 mb-2">
                        <i class="fas fa-clipboard-list text-4xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Belum ada layanan</h3>
                    <p class="text-gray-500 mt-1">Mulai dengan menambahkan layanan baru</p>
                    <a href="{{ route('layanan.create') }}" 
                       class="inline-flex items-center px-4 py-2 mt-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        <i class="fas fa-plus mr-2"></i>
                        <span>Tambah Layanan</span>
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Success Message Toast -->
    @if(session('success'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg" 
             x-data="{ show: true }"
             x-show="show"
             x-init="setTimeout(() => show = false, 3000)">
            <div class="flex items-center space-x-2">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif
@endsection