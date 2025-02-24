<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Top Navigation Bar -->
    <nav class="bg-white h-16 fixed w-full z-10 shadow-sm px-4">
        <div class="flex items-center justify-between h-full">
            <div class="flex items-center">
                <button id="sidebar-toggle" class="p-2 rounded-lg hover:bg-gray-100 lg:hidden">
                    <i class="fas fa-bars text-gray-500 text-sm"></i> <!-- Menggunakan text-sm -->
                </button>
                <img src="{{ asset('storage/images/logobirojova.png')}}" alt="Logo" class="h-8 w-auto ml-3 object-contain">
            </div>            
            <div class="flex items-center space-x-4">
                <button class="p-2 rounded-full hover:bg-gray-100">
                    <i class="fas fa-bell text-gray-600"></i>
                </button>
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('storage/images/hutaomcd.jpg')}}" alt="Profile" class="h-8 w-8 rounded-full">
                    <span class="text-gray-700 font-medium hidden md:block">Admin</span>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex pt-16">
        <!-- Sidebar -->
        <aside class="fixed left-0 z-20 w-64 h-screen transition-transform -translate-x-full lg:translate-x-0" aria-label="Sidebar">
            <div class="h-full px-3 py-4 overflow-y-auto bg-gray-800">
                <div class="mb-8 mt-4">
                    <h2 class="text-2xl font-bold text-white px-4">Admin Panel</h2>
                </div>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center p-4 text-gray-100 rounded-lg hover:bg-gray-700 group transition duration-300">
                            <i class="fas fa-home w-5 h-5"></i>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('layanan.index') }}" 
                           class="flex items-center p-4 text-gray-100 rounded-lg hover:bg-gray-700 group transition duration-300">
                            <i class="fas fa-cogs w-5 h-5"></i>
                            <span class="ml-3">Layanan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pengajuan.index') }}" 
                           class="flex items-center p-4 text-gray-100 rounded-lg hover:bg-gray-700 group transition duration-300">
                            <i class="fas fa-file-alt w-5 h-5"></i>
                            <span class="ml-3">Pengajuan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pendapatan.index') }}" 
                           class="flex items-center p-4 text-gray-100 rounded-lg hover:bg-gray-700 group transition duration-300">
                            <i class="fas fa-wallet w-5 h-5"></i>
                            <span class="ml-3">Pendapatan</span>
                        </a>
                    </li>
                    <li class="mt-auto">
                        <form action="{{ route('admin.logout') }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit" 
                                    class="flex items-center w-full p-4 text-gray-100 rounded-lg hover:bg-red-600 group transition duration-300">
                                <i class="fas fa-sign-out-alt w-5 h-5"></i>
                                <span class="ml-3">Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 lg:ml-64 p-8">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <!-- Sidebar Toggle Script -->
    <script>
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.querySelector('aside');
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>

    <style>
    .empty-state {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    </style>
</body>
</html>