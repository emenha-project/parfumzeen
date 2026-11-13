<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Atelier') — ZEEN PARFUM</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        gold: {
                            50: '#FBF8F1',
                            100: '#F4ECE0',
                            200: '#E7D8BD',
                            300: '#D5BD94',
                            400: '#C5A880',
                            500: '#B8925A',
                            600: '#9B7443',
                            700: '#7B5933',
                            800: '#64472C',
                            900: '#523B27',
                        },
                        onyx: {
                            900: '#0A0A0A',
                            850: '#111113',
                            800: '#18181B',
                            700: '#27272A',
                            600: '#3F3F46',
                        }
                    },
                    fontFamily: {
                        serif: ['"Playfair Display"', 'Georgia', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0A0A0A;
            color: #E4E4E7;
        }
        .font-serif-lux {
            font-family: 'Playfair Display', Georgia, serif;
        }
        /* Custom scrollbars */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #111113;
        }
        ::-webkit-scrollbar-thumb {
            background: #27272A;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #C5A880;
        }
    </style>
</head>
<body class="min-h-screen bg-onyx-900 text-zinc-200 antialiased selection:bg-gold-500/20 selection:text-gold-300">

    <div class="flex h-screen overflow-hidden">
        <!-- SIDEBAR -->
        <aside class="w-64 bg-onyx-850 border-r border-zinc-800/80 flex flex-col justify-between shrink-0 hidden md:flex">
            <div>
                <!-- Brand Header -->
                <div class="h-20 flex items-center justify-between px-6 border-b border-zinc-800/80">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                        <div class="w-9 h-9 rounded bg-gold-400/10 border border-gold-400/30 flex items-center justify-center text-gold-400 font-serif-lux font-bold text-lg group-hover:scale-105 transition-transform">
                            Z
                        </div>
                        <div>
                            <div class="font-serif-lux tracking-[0.25em] text-sm text-zinc-100 font-semibold uppercase">ZEEN</div>
                            <div class="text-[10px] tracking-widest text-gold-400 uppercase">Haute Parfumerie</div>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <nav class="p-4 space-y-1.5 text-xs font-medium">
                    <div class="px-3 pb-2 pt-1 text-[10px] uppercase tracking-wider text-zinc-500 font-semibold">Menu Utama</div>

                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-gold-400/15 text-gold-300 font-semibold border-l-2 border-gold-400' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-800/50' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Dashboard Atelier</span>
                    </a>

                    <a href="{{ route('admin.products.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.products.*') ? 'bg-gold-400/15 text-gold-300 font-semibold border-l-2 border-gold-400' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-800/50' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        <span>Katalog Parfum</span>
                    </a>

                    <a href="{{ route('admin.categories.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.categories.*') ? 'bg-gold-400/15 text-gold-300 font-semibold border-l-2 border-gold-400' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-800/50' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        <span>Famille Olfactive (Kategori)</span>
                    </a>

                    <a href="{{ route('admin.orders.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.orders.*') ? 'bg-gold-400/15 text-gold-300 font-semibold border-l-2 border-gold-400' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-800/50' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        <span>Pesanan & Transaksi</span>
                    </a>

                    <div class="px-3 pb-2 pt-5 text-[10px] uppercase tracking-wider text-zinc-500 font-semibold">Toko Eksternal</div>

                    <a href="{{ route('home') }}" target="_blank"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-zinc-400 hover:text-gold-300 hover:bg-zinc-800/50 transition-all">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        <span>Lihat Website Toko</span>
                    </a>
                </nav>
            </div>

            <!-- User Footer & Logout -->
            <div class="p-4 border-t border-zinc-800/80 bg-onyx-900/40">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-8 h-8 rounded-full bg-gold-400/20 border border-gold-400/30 flex items-center justify-center text-xs font-bold text-gold-300 shrink-0">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div class="truncate">
                            <div class="text-xs font-medium text-zinc-200 truncate">{{ auth()->user()->name ?? 'Administrator' }}</div>
                            <div class="text-[10px] text-zinc-500 truncate">{{ auth()->user()->email ?? 'admin@zeenparfum.com' }}</div>
                        </div>
                    </div>

                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" title="Keluar / Logout" class="p-1.5 text-zinc-500 hover:text-red-400 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden">
            <!-- Topbar Header -->
            <header class="h-20 bg-onyx-850/70 backdrop-blur-md border-b border-zinc-800/80 px-6 sm:px-8 flex items-center justify-between shrink-0">
                <div class="flex items-center gap-4">
                    <!-- Mobile Hamburger -->
                    <button type="button" onclick="document.querySelector('aside').classList.toggle('hidden')" class="md:hidden text-zinc-400 hover:text-zinc-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div>
                        <h1 class="text-lg font-serif-lux font-semibold text-zinc-100">@yield('page_title', 'Dashboard')</h1>
                        <p class="text-[11px] text-zinc-400 hidden sm:block">@yield('page_subtitle', 'Kelola inventaris dan pesanan parfum mewah ZEEN')</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    @yield('actions')

                    <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-gold-500 to-gold-400 hover:from-gold-400 hover:to-gold-300 text-onyx-900 font-semibold px-3.5 py-2 rounded-lg text-xs tracking-wider transition-all shadow-md shadow-gold-500/10">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        <span>Tambah Parfum</span>
                    </a>
                </div>
            </header>

            <!-- Alerts Container -->
            <div class="px-6 sm:px-8 pt-4">
                @if (session('success'))
                    <div class="p-3.5 rounded-lg bg-emerald-950/60 border border-emerald-500/30 text-emerald-300 text-xs flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 shrink-0 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-emerald-400/60 hover:text-emerald-300">&times;</button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="p-3.5 rounded-lg bg-rose-950/60 border border-rose-500/30 text-rose-300 text-xs flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 shrink-0 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-rose-400/60 hover:text-rose-300">&times;</button>
                    </div>
                @endif
            </div>

            <!-- Main Scrollable Body -->
            <main class="flex-1 overflow-y-auto px-6 sm:px-8 py-6">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>

