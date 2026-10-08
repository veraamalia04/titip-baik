<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ env('APP_NAME', "Titip Baik") }}</title>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900">
    <!-- Wrapper utama -->
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <!-- w-64 untuk posisi terbuka, transition-all untuk efek animasi halus -->
        <aside id="sidebar" class="w-64 flex flex-col bg-white border-r border-gray-200 transition-all duration-300">
            
            <!-- Logo Area -->
            <div class="flex items-center justify-center h-16 border-b border-gray-200">
                <span id="logo-full" class="text-xl font-bold text-pink-600 whitespace-nowrap">{{ env('APP_NAME', "Titip Baik") }}</span>
                <span id="logo-icon" class="hidden text-xl font-bold text-pink-600">TB</span>
            </div>

            <!-- Menu / Navigasi -->
            <nav class="flex-1 px-4 py-4 space-y-2 overflow-y-auto">
                <!-- Link Dashboard -->
                <a href="#" class="flex items-center px-2 py-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="sidebar-text ml-3 whitespace-nowrap">Dashboard</span>
                </a>
                
                <!-- Link Contoh Lain (Bisa dihapus jika tidak perlu) -->
                <a href="#" class="flex items-center px-2 py-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="sidebar-text ml-3 whitespace-nowrap">Menu Lain</span>
                </a>
            </nav>

            <!-- Footer Sidebar (Tombol Logout) -->
            <div class="p-4 border-t border-gray-200">
                <form method="POST" action="{{ route('post.dashboard.logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-2 py-2 text-red-600 rounded-lg hover:bg-red-50 transition-colors">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span class="sidebar-text ml-3 whitespace-nowrap">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Area Konten Utama -->
        <div class="flex flex-col flex-1 overflow-hidden">
            
            <!-- Header Atas -->
            <header class="flex items-center justify-between h-16 px-6 bg-white border-b border-gray-200 shadow-sm">
                
                <!-- Tombol Toggle Sidebar (Hamburger Icon) -->
                <button onclick="toggleSidebar()" class="p-2 text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Informasi User Login -->
                <div class="flex items-center gap-3">
                    <div class="text-right">
                        <!-- Menampilkan Nama User dari Laravel Auth -->
                        <div class="text-sm font-medium text-gray-800">{{ Auth::user()->name ?? 'Guest User' }}</div>
                        <!-- Menampilkan Email User -->
                        <div class="text-xs text-gray-500">{{ Auth::user()->email ?? 'guest@example.com' }}</div>
                    </div>
                    <!-- Avatar Inisial -->
                    <div class="w-10 h-10 rounded-full bg-pink-400 flex items-center justify-center text-white font-bold border border-blue-200">
                        {{ substr(Auth::user()->name ?? 'G', 0, 1) }}
                    </div>
                </div>
            </header>

            <!-- Slot Konten Halaman -->
            <main class="flex-1 p-6 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Script untuk Toggle Sidebar -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const texts = document.querySelectorAll('.sidebar-text');
            const logoFull = document.getElementById('logo-full');
            const logoIcon = document.getElementById('logo-icon');

            if (sidebar.classList.contains('w-64')) {
                // Mengecilkan Sidebar
                sidebar.classList.replace('w-64', 'w-20');
                
                // Menyembunyikan teks menu dan logo penuh
                texts.forEach(el => el.classList.add('hidden'));
                logoFull.classList.add('hidden');
                logoIcon.classList.remove('hidden');
            } else {
                // Melebarkan Sidebar
                sidebar.classList.replace('w-20', 'w-64');
                
                // Menampilkan teks menu dan logo penuh kembali
                texts.forEach(el => el.classList.remove('hidden'));
                logoFull.classList.remove('hidden');
                logoIcon.classList.add('hidden');
            }
        }
    </script>
</body>
</html>