@extends('admin.layout')

@section('content')
<div class="container max-w-2xl mx-auto p-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Layanan</h2>
        
        <form action="{{ route('layanan.update', $layanan->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Nama Layanan -->
            <div class="space-y-2">
                <label for="nama_layanan" class="block text-sm font-medium text-gray-700">
                    Nama Layanan
                </label>
                <input 
                    type="text" 
                    name="nama_layanan" 
                    id="nama_layanan"
                    value="{{ old('nama_layanan', $layanan->nama_layanan) }}"
                    required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2"
                >
            </div>

            <!-- Deskripsi -->
            <div class="space-y-2">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">
                    Deskripsi
                </label>
                <textarea 
                    name="deskripsi" 
                    id="deskripsi"
                    rows="4"
                    required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2"
                >{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
            </div>

            <!-- Harga Modal -->
            <div class="space-y-2">
                <label for="harga_modal" class="block text-sm font-medium text-gray-700">
                    Harga Modal
                </label>
                <input 
                    type="number" 
                    name="harga_modal" 
                    id="harga_modal"
                    value="{{ old('harga_modal', $layanan->harga_modal) }}"
                    required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2"
                >
            </div>

            <!-- Harga Jual -->
            <div class="space-y-2">
                <label for="harga_jual" class="block text-sm font-medium text-gray-700">
                    Harga Jual
                </label>
                <input 
                    type="number" 
                    name="harga_jual" 
                    id="harga_jual"
                    value="{{ old('harga_jual', $layanan->harga_jual) }}"
                    required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2"
                >
            </div>

            <!-- Tombol Submit & Cancel -->
            <div class="flex gap-4 pt-4">
                <button 
                    type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    Update
                </button>
                <button 
                    type="button" 
                    onclick="history.back()" 
                    class="inline-flex justify-center rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
