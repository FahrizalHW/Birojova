@extends('admin.layout')

@section('content')
    <!-- Add this at the top of your content section -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <!-- Modal untuk menampilkan data -->
    <div id="statusModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-4xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 id="modalTitle" class="text-xl font-semibold"></h2>
                    <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="overflow-x-auto max-h-[70vh]">
                    <table class="min-w-full">
                        <thead>
                            <tr class="text-sm font-medium text-gray-700 border-b border-gray-200">
                                <th class="py-3 px-4 text-left">No</th>
                                <th class="py-3 px-4 text-left">Tanggal</th>
                                <th class="py-3 px-4 text-left">Pemohon</th>
                                <th class="py-3 px-4 text-left">Layanan</th>
                                <th class="py-3 px-4 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody id="modalTableBody" class="text-sm text-gray-600">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <!-- Dashboard Header -->
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
            <div class="text-sm text-gray-500">Last updated: {{ now()->format('d M Y, H:i') }}</div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
            <!-- Card 1: Total Pengajuan -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 transition-all hover:shadow-md">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-file-alt text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Pengajuan</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalPengajuan }}</p>
                    </div>
                </div>
            </div>
        
            <!-- Card 2: Pending -->
            <div onclick="showStatusData('pending', 'Pengajuan Pending')" class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 transition-all hover:shadow-md cursor-pointer">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Pending</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $pending }}</p>
                    </div>
                </div>
            </div>
        
            <!-- Card 3: Dalam Proses -->
            <div onclick="showStatusData('proses', 'Pengajuan Dalam Proses')" class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 transition-all hover:shadow-md cursor-pointer">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-spinner text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Dalam Proses</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $proses }}</p>
                    </div>
                </div>
            </div>
        
            <!-- Card 4: Siap Diambil -->
            <div onclick="showStatusData('ready', 'Pengajuan Siap Diambil')" class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 transition-all hover:shadow-md cursor-pointer">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fas fa-check text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Siap Diambil</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $ready }}</p>
                    </div>
                </div>
            </div>
        
            <!-- Card 5: Ditolak -->
            <div onclick="showStatusData('ditolak', 'Pengajuan Ditolak')" class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 transition-all hover:shadow-md cursor-pointer">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100 text-red-600">
                        <i class="fas fa-times text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Ditolak</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $ditolak }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Chart and Recent Applications -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Statistik Pengajuan</h2>
                <div class="relative" style="height: 300px;">
                    <canvas id="pengajuanChart"></canvas>
                </div>
            </div>

        <!-- ... -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Pengajuan Terbaru</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="text-sm font-medium text-gray-700 border-b border-gray-200">
                            <th class="py-3 px-4 text-left">Pemohon</th>
                            <th class="py-3 px-4 text-left">Layanan</th>
                            <th class="py-3 px-4 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-600">
                        @foreach($pengajuanTerbaru as $pengajuan)
                            <tr class="border-b border-gray-200">
                                <td class="py-3 px-4">{{ $pengajuan->nama_pemohon }}</td>
                                <td class="py-3 px-4">{{ $pengajuan->layanan->nama_layanan }}</td>
                                <td class="py-3 px-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium
                                        @if($pengajuan->status == 'ready') 
                                            bg-green-100 text-green-800
                                        @elseif($pengajuan->status == 'proses')
                                            bg-blue-100 text-blue-800
                                        @elseif($pengajuan->status == 'pending')
                                            bg-yellow-100 text-yellow-800
                                        @else
                                            bg-red-100 text-red-800
                                        @endif
                                    ">
                                        {{ ucfirst($pengajuan->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('layanan.index') }}" 
                   class="flex items-center justify-center p-4 bg-blue-600 text-white rounded-xl shadow-sm hover:bg-blue-700 transition-colors">
                    <i class="fas fa-cogs mr-2"></i>
                    <span class="font-medium">Kelola Layanan</span>
                </a>
                <a href="{{ route('pengajuan.index') }}" 
                   class="flex items-center justify-center p-4 bg-blue-600 text-white rounded-xl shadow-sm hover:bg-blue-700 transition-colors">
                    <i class="fas fa-file-alt mr-2"></i>
                    <span class="font-medium">Kelola Pengajuan</span>
                </a>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('export.pdf') }}" 
                   class="flex items-center justify-center p-4 bg-red-600 text-white rounded-xl shadow-sm hover:bg-red-700 transition-colors">
                    <i class="fas fa-file-pdf mr-2"></i>
                    <span class="font-medium">Download PDF</span>
                </a>
                <a href="{{ route('export-pengajuan') }}" 
                   class="flex items-center justify-center p-4 bg-green-600 text-white rounded-xl shadow-sm hover:bg-green-700 transition-colors">
                    <i class="fas fa-file-excel mr-2"></i>
                    <span class="font-medium">Export Excel</span>
                </a>
            </div>
        </div>
    </div>
</div>

    <script>
        // Fungsi untuk menampilkan modal dan mengambil data
        async function showStatusData(status, title) {
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('statusModal').classList.remove('hidden');
            
            try {
                const response = await fetch(`/pengajuan/status/${status}`);
                const data = await response.json();
                
                const tableBody = document.getElementById('modalTableBody');
                tableBody.innerHTML = '';
                
                data.forEach((item, index) => {
                    const statusClass = 
                        item.status === 'ready' ? 'bg-green-100 text-green-800' :
                        item.status === 'proses' ? 'bg-blue-100 text-blue-800' :
                        'bg-red-100 text-red-800';
                    
                    const row = `
                        <tr class="border-b border-gray-200">
                            <td class="py-3 px-4">${index + 1}</td>
                            <td class="py-3 px-4">${new Date(item.created_at).toLocaleDateString('id-ID')}</td>
                            <td class="py-3 px-4">${item.nama_pemohon}</td>
                            <td class="py-3 px-4">${item.layanan.nama_layanan}</td>
                            <td class="py-3 px-4">
                                <span class="px-3 py-1 rounded-full text-xs font-medium ${statusClass}">
                                    ${item.status}
                                </span>
                            </td>
                        </tr>
                    `;
                    tableBody.innerHTML += row;
                });
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            document.getElementById('statusModal').classList.add('hidden');
        }

        // Chart initialization code
        document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('pengajuanChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Proses', 'Ready', 'Ditolak'],
            datasets: [{
                data: [{{ $pending }}, {{ $proses }}, {{ $ready }}, {{ $ditolak }}],
                backgroundColor: [
                    'rgba(251, 191, 36, 0.8)',
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(34, 197, 94, 0.8)',
                    'rgba(239, 68, 68, 0.8)'
                ],
                borderColor: [
                    'rgba(251, 191, 36, 1)',
                    'rgba(59, 130, 246, 1)',
                    'rgba(34, 197, 94, 1)',
                    'rgba(239, 68, 68, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        font: {
                            size: 12
                        }
                    }
                }
            },
            cutout: '70%',
            animation: {
                animateScale: true
            }
        }
    });
});
    </script>
@endsection