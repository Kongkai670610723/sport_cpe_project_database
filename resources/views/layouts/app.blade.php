<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SPORT.CPE — ร้านอุปกรณ์กีฬาครบวงจร')</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0F172A',
                        accentGreen: '#22C55E',
                        accentOrange: '#FF6B00',
                        dangerRed: '#C40000',
                        bgSlate: '#F1F5F9',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-bgSlate font-sans text-slate-800 min-h-screen flex flex-col">

    <!-- Top Navigation Bar (Figma Master Style) -->
    <header class="bg-primary text-white sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-4 h-16 flex items-center justify-between gap-4">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 font-black text-xl tracking-wider text-white hover:opacity-90">
                <span class="text-2xl">🏃</span> SPORT<span class="text-accentOrange">.CPE</span>
            </a>

            <!-- Search Bar -->
            <form action="{{ route('products.index') }}" method="GET" class="flex-1 max-w-lg hidden md:block">
                <div class="relative">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Search equipment, shoes, gear..." 
                        value="{{ request('search') }}"
                        class="w-full bg-slate-800/80 text-white placeholder-slate-400 text-sm rounded-lg pl-10 pr-4 py-2 border border-slate-700 focus:outline-none focus:border-accentOrange"
                    >
                    <span class="absolute left-3 top-2.5 text-slate-400">🔍</span>
                </div>
            </form>

            <!-- Navigation Actions -->
            <div class="flex items-center gap-3">
                <a href="{{ route('vouchers.index') }}" class="text-sm font-semibold text-slate-200 hover:text-accentOrange hidden sm:inline-block">
                    คูปองส่วนลด
                </a>

                <a href="{{ route('cart.index') }}" class="flex items-center gap-2 bg-accentGreen hover:bg-green-600 text-white px-4 py-2 rounded-lg font-bold text-sm transition">
                    <span>🛒 Cart</span>
                    <span class="bg-white/20 px-2 py-0.5 rounded-full text-xs">{{ count(session('cart', [1, 2])) }}</span>
                </a>

                @if(Auth::check())
                    <a href="{{ route('profile') }}" class="flex items-center gap-2 text-sm font-medium hover:text-slate-300">
                        <span class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center font-bold text-xs text-white">KK</span>
                        <span class="hidden md:inline">{{ Auth::user()->name }}</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="flex items-center gap-1.5 border border-slate-600 hover:border-slate-400 px-3 py-1.5 rounded-lg text-sm font-medium">
                        <span>👤 Login</span>
                    </a>
                @endif
            </div>
        </div>

        <!-- Category Menu Bar (8 Sports Categories) -->
        <nav class="bg-slate-900 border-t border-slate-800 text-xs md:text-sm font-medium overflow-x-auto">
            <div class="max-w-7xl mx-auto px-4 flex items-center gap-6 h-11 whitespace-nowrap">
                <a href="{{ route('home') }}" class="py-2.5 border-b-2 {{ request()->routeIs('home') ? 'border-accentOrange text-white font-bold' : 'border-transparent text-slate-400 hover:text-white' }}">
                    Home
                </a>
                <a href="{{ route('products.index', ['category' => 'running']) }}" class="py-2.5 border-b-2 {{ request('category') === 'running' ? 'border-accentOrange text-white font-bold' : 'border-transparent text-slate-400 hover:text-white' }}">
                    Running
                </a>
                <a href="{{ route('products.index', ['category' => 'badminton']) }}" class="py-2.5 border-b-2 {{ request('category') === 'badminton' ? 'border-accentOrange text-white font-bold' : 'border-transparent text-slate-400 hover:text-white' }}">
                    Badminton
                </a>
                <a href="{{ route('products.index', ['category' => 'basketball']) }}" class="py-2.5 border-b-2 {{ request('category') === 'basketball' ? 'border-accentOrange text-white font-bold' : 'border-transparent text-slate-400 hover:text-white' }}">
                    Basketball
                </a>
                <a href="{{ route('products.index', ['category' => 'football']) }}" class="py-2.5 border-b-2 {{ request('category') === 'football' ? 'border-accentOrange text-white font-bold' : 'border-transparent text-slate-400 hover:text-white' }}">
                    Football
                </a>
                <a href="{{ route('products.index', ['category' => 'swim']) }}" class="py-2.5 border-b-2 {{ request('category') === 'swim' ? 'border-accentOrange text-white font-bold' : 'border-transparent text-slate-400 hover:text-white' }}">
                    Swim
                </a>
                <a href="{{ route('products.index', ['category' => 'fitness']) }}" class="py-2.5 border-b-2 {{ request('category') === 'fitness' ? 'border-accentOrange text-white font-bold' : 'border-transparent text-slate-400 hover:text-white' }}">
                    Fitness
                </a>
                <a href="{{ route('products.index', ['category' => 'camping']) }}" class="py-2.5 border-b-2 {{ request('category') === 'camping' ? 'border-accentOrange text-white font-bold' : 'border-transparent text-slate-400 hover:text-white' }}">
                    Camping
                </a>
                <a href="{{ route('products.index', ['category' => 'volleyball']) }}" class="py-2.5 border-b-2 {{ request('category') === 'volleyball' ? 'border-accentOrange text-white font-bold' : 'border-transparent text-slate-400 hover:text-white' }}">
                    Volleyball
                </a>
            </div>
        </nav>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-primary text-slate-400 text-sm py-8 border-t border-slate-800 mt-12">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2 text-white font-bold">
                <span>🏃 SPORT.CPE</span>
                <span class="text-xs text-slate-400 font-normal">| 261342 Database Systems Term Project (CPE CMU)</span>
            </div>
            <div class="flex items-center gap-4 text-xs text-slate-400">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-accentOrange">🛡️ Admin Portal</a>
                <span>•</span>
                <a href="{{ route('vouchers.index') }}" class="hover:text-accentOrange">Voucher Center</a>
                <span>•</span>
                <span>Team: ณภัทร, ภูรินท์, วรภพ</span>
            </div>
        </div>
    </footer>

</body>
</html>
