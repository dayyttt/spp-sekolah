<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title') - SPP SMA N 1 KERAJAAN</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#135bec",
                        "background-light": "#f6f6f8",
                        "background-dark": "#101622",
                    },
                    fontFamily: {
                        "display": ["Lexend", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem", 
                        "lg": "0.5rem", 
                        "xl": "0.75rem", 
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Lexend', sans-serif; }
        .material-symbols-outlined { 
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; 
        }
        @media (max-width: 768px) {
            .sidebar-mobile {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }
            .sidebar-mobile.active {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 antialiased">
    <!-- Mobile Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"></div>

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar-mobile fixed md:static inset-y-0 left-0 z-50 w-64 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 flex flex-col">
            <div class="p-6 flex items-center gap-3">
                <div class="bg-primary p-2 rounded-lg">
                    <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo" class="w-6 h-6 object-contain">
                </div>
                <div>
                    <h1 class="text-slate-900 dark:text-white font-bold text-lg leading-tight">SPP Sekolah</h1>
                    <p class="text-xs text-slate-500 font-medium">SMA N 1 KERAJAAN</p>
                </div>
            </div>

            <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-primary/10 text-primary' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }} group" href="{{ route('dashboard') }}">
                    <span class="material-symbols-outlined text-[20px]">dashboard</span>
                    <span class="text-sm font-semibold">Dashboard</span>
                </a>
                
                @if(auth()->user()->role === 'admin')
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('kelas.*') ? 'bg-primary/10 text-primary' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }} group" href="{{ route('kelas.index') }}">
                    <span class="material-symbols-outlined text-[20px]">school</span>
                    <span class="text-sm font-medium">Data Kelas</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('siswa.*') ? 'bg-primary/10 text-primary' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }} group" href="{{ route('siswa.index') }}">
                    <span class="material-symbols-outlined text-[20px]">groups</span>
                    <span class="text-sm font-medium">Data Siswa</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('tahun-ajaran.*') ? 'bg-primary/10 text-primary' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }} group" href="{{ route('tahun-ajaran.index') }}">
                    <span class="material-symbols-outlined text-[20px]">calendar_today</span>
                    <span class="text-sm font-medium">Tahun Ajaran</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('rekening.*') ? 'bg-primary/10 text-primary' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }} group" href="{{ route('rekening.index') }}">
                    <span class="material-symbols-outlined text-[20px]">account_balance</span>
                    <span class="text-sm font-medium">Rekening</span>
                </a>
                @endif
                
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('pembayaran.*') ? 'bg-primary/10 text-primary' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }} group" href="{{ route('pembayaran.index') }}">
                    <span class="material-symbols-outlined text-[20px]">receipt_long</span>
                    <span class="text-sm font-medium">Pembayaran</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('laporan.*') ? 'bg-primary/10 text-primary' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800' }} group" href="{{ route('laporan.index') }}">
                    <span class="material-symbols-outlined text-[20px]">bar_chart</span>
                    <span class="text-sm font-medium">Laporan</span>
                </a>
            </nav>

            <div class="p-4 border-t border-slate-200 dark:border-slate-800">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 group w-full">
                        <span class="material-symbols-outlined text-[20px]">logout</span>
                        <span class="text-sm font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-w-0 overflow-hidden w-full">
            <!-- Header -->
            <header class="h-16 bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between px-4 md:px-8 shrink-0">
                <div class="flex items-center gap-4 flex-1">
                    <!-- Mobile Menu Button -->
                    <button id="menuBtn" class="md:hidden p-2 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                    <h2 class="text-lg md:text-xl font-bold text-slate-900 dark:text-white truncate">@yield('page-title')</h2>
                </div>
                <div class="flex items-center gap-2 md:gap-4">
                    <div class="hidden md:block h-8 w-[1px] bg-slate-200 dark:bg-slate-700 mx-2"></div>
                    <div class="flex items-center gap-2 md:gap-3">
                        <div class="hidden sm:block text-right">
                            <p class="text-sm font-semibold text-slate-900 dark:text-white leading-none">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-500 font-medium capitalize">{{ auth()->user()->role }}</p>
                        </div>
                        <div class="h-8 w-8 md:h-10 md:w-10 rounded-full bg-primary/20 flex items-center justify-center border-2 border-primary/10">
                            <span class="material-symbols-outlined text-primary text-[20px] md:text-[24px]">person</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8">
                @if(session('success'))
                    <div class="mb-4 md:mb-6 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 px-4 py-3 rounded-lg flex items-center gap-3">
                        <span class="material-symbols-outlined text-[20px]">check_circle</span>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Mobile Menu Toggle
        const menuBtn = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        function toggleMenu() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
        }

        menuBtn?.addEventListener('click', toggleMenu);
        overlay?.addEventListener('click', toggleMenu);

        // Close menu when clicking nav link on mobile
        const navLinks = sidebar.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    toggleMenu();
                }
            });
        });

        // Close menu on window resize to desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('active');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
