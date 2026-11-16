<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReWear - Marketplace Preloved</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        rewear: {
                            primary: '#4A5D4E',      // Sage/Earthy Green
                            secondary: '#8F9E8B',
                            light: '#F4F6F3',        // Soft background
                            accent: '#D0D7CD',
                            dark: '#2C352D'
                        }
                    }
                }
            }
        }
    </script>
    <!-- FontAwesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-rewear-light text-rewear-dark font-sans antialiased min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex justify-between items-center">
            
            <!-- Bagian Kiri: Logo & Menu Navigasi -->
            <div class="flex items-center space-x-8">
                <a href="{{ url('/') }}" class="text-2xl font-bold tracking-wider text-rewear-primary flex items-center">
                    <i class="fa-solid fa-shirt mr-2"></i>ReWear
                </a>

                <!-- Daftar Menu -->
                <div class="hidden sm:flex items-center space-x-6">
                    <a href="{{ route('pesanan.index') }}" 
                       class="text-sm font-medium transition flex items-center space-x-1.5 {{ request()->routeIs('pesanan.*') ? 'text-rewear-primary font-semibold border-b-2 border-rewear-primary py-5' : 'text-gray-600 hover:text-rewear-primary' }}">
                        <i class="fa-solid fa-bag-shopping text-xs"></i>
                        <span>Kelola Pesanan</span>
                    </a>
                </div>
            </div>

            <!-- Bagian Kanan: Profil User -->
            <div class="flex items-center space-x-4">
                <span class="text-sm font-medium text-gray-600">Halo, Nana</span>
                <div class="h-8 w-8 rounded-full bg-rewear-primary text-white flex items-center justify-center font-bold">
                    N
                </div>
            </div>

        </div>
    </nav>

    <!-- Content Wrapper -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-4 text-center text-xs text-gray-500">
        &copy; 2026 ReWear Preloved Marketplace. All rights reserved.
    </footer>

</body>
</html>