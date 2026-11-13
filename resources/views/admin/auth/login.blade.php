<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin Atelier — ZEEN PARFUM</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        gold: {
                            400: '#C5A880',
                            500: '#B8925A',
                        },
                        onyx: {
                            900: '#0A0A0A',
                            850: '#111113',
                            800: '#18181B',
                            700: '#27272A',
                        }
                    },
                    fontFamily: {
                        serif: ['"Playfair Display"', 'Georgia', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-onyx-900 text-zinc-200 flex items-center justify-center p-4 selection:bg-gold-500/20 selection:text-gold-300 font-sans relative overflow-hidden">

    <!-- Atmospheric Glow Background -->
    <div class="absolute w-[500px] h-[500px] rounded-full bg-gold-500/5 blur-[120px] pointer-events-none top-1/4 left-1/2 -translate-x-1/2"></div>

    <div class="w-full max-w-md relative z-10">
        <!-- Logo Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-gold-400/10 border border-gold-400/30 text-gold-400 font-serif text-2xl font-bold mb-4 shadow-xl shadow-gold-500/5">
                Z
            </div>
            <h1 class="text-2xl font-serif tracking-[0.2em] font-semibold text-zinc-100 uppercase">ZEEN PARFUM</h1>
            <p class="text-xs text-gold-400 tracking-widest uppercase mt-1">Haute Parfumerie Atelier CMS</p>
        </div>

        <!-- Login Card -->
        <div class="bg-onyx-850/90 backdrop-blur-xl border border-zinc-800/90 rounded-2xl p-8 shadow-2xl relative">
            <h2 class="text-base font-semibold text-zinc-100 mb-1">Masuk Administrator</h2>
            <p class="text-xs text-zinc-400 mb-6">Akses panel kelola produk, stok, dan transaksi pesanan.</p>

            @if ($errors->any())
                <div class="mb-5 p-3 rounded-lg bg-rose-950/60 border border-rose-500/30 text-rose-300 text-xs">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('info'))
                <div class="mb-5 p-3 rounded-lg bg-blue-950/60 border border-blue-500/30 text-blue-300 text-xs">
                    {{ session('info') }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs uppercase tracking-wider text-zinc-400 mb-1.5 font-medium">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email', 'admin@zeenparfum.com') }}" required autofocus
                           class="w-full px-4 py-2.5 rounded-lg bg-onyx-900 border border-zinc-700/80 text-zinc-100 text-sm focus:outline-none focus:border-gold-400 transition-colors">
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-wider text-zinc-400 mb-1.5 font-medium">Kata Sandi (Password)</label>
                    <input type="password" name="password" required value="admin123"
                           class="w-full px-4 py-2.5 rounded-lg bg-onyx-900 border border-zinc-700/80 text-zinc-100 text-sm focus:outline-none focus:border-gold-400 transition-colors">
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 cursor-pointer text-zinc-400 hover:text-zinc-200">
                        <input type="checkbox" name="remember" checked class="rounded bg-onyx-900 border-zinc-700 text-gold-500 focus:ring-0 focus:ring-offset-0">
                        <span>Ingat saya</span>
                    </label>
                </div>

                <button type="submit"
                        class="w-full mt-2 py-3 bg-gradient-to-r from-gold-500 to-gold-400 hover:from-gold-400 hover:to-gold-300 text-onyx-900 font-semibold text-xs tracking-widest uppercase rounded-lg shadow-lg shadow-gold-500/10 transition-all">
                    Masuk ke Atelier CMS
                </button>
            </form>

            <!-- Quick Demo Credentials Box -->
            <div class="mt-6 pt-5 border-t border-zinc-800 text-[11px] text-zinc-400 bg-onyx-900/60 p-3 rounded-lg border border-zinc-800/60">
                <div class="text-gold-400 font-medium mb-1 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Kredensial Default (Seeder):</span>
                </div>
                <div class="flex justify-between py-0.5">
                    <span>Email:</span> <code class="text-zinc-200 font-mono">admin@zeenparfum.com</code>
                </div>
                <div class="flex justify-between py-0.5">
                    <span>Password:</span> <code class="text-zinc-200 font-mono">admin123</code>
                </div>
            </div>
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-xs text-zinc-500 hover:text-gold-300 transition-colors">
                &larr; Kembali ke Etalase Toko
            </a>
        </div>
    </div>

</body>
</html>

