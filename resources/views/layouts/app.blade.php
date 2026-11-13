<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ZEEN PARFUM | Haute Parfumerie & Luxury Fragrances')</title>
    <meta name="description" content="@yield('meta_description', 'ZEEN PARFUM - Luxury Haute Parfumerie terinspirasi kemurnian esensi alam dengan konsentrasi Extrait de Parfum 35%.')">

    <!-- Fonts: Playfair Display (Serif Luxury) & Plus Jakarta Sans (Clean Minimalist Body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        serif: ['"Playfair Display"', 'Georgia', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        luxury: {
                            black: '#0A0A0A',
                            charcoal: '#171717',
                            dark: '#262626',
                            gold: '#D4AF37',
                            champagne: '#E5D3B3',
                            bronze: '#A37D46',
                            cream: '#FAF8F5',
                            border: '#E8E8E8',
                            muted: '#737373',
                        }
                    },
                    letterSpacing: {
                        luxury: '0.22em',
                        widest: '0.15em',
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FFFFFF;
            color: #0A0A0A;
            -webkit-font-smoothing: antialiased;
        }
        .font-serif-luxury {
            font-family: 'Playfair Display', Georgia, serif;
            letter-spacing: -0.01em;
        }
        .tracking-luxury {
            letter-spacing: 0.18em;
        }
        /* Custom sleek scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #F5F5F5;
        }
        ::-webkit-scrollbar-thumb {
            background: #000000;
        }
        /* Hide scrollbar for tabs */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        /* Drawer backdrop */
        .drawer-overlay {
            transition: opacity 0.3s ease;
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col antialiased bg-white selection:bg-black selection:text-white">

    <!-- 1. TOP ANNOUNCEMENT BAR (Sephora Style Ticker) -->
    <div class="bg-black text-white text-[11px] uppercase tracking-luxury font-medium py-2.5 px-4 text-center border-b border-neutral-800">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <span class="hidden md:inline-block text-neutral-400">HAUTE PARFUMERIE • JAKARTA</span>
            <div class="mx-auto flex items-center space-x-6">
                <span>✨ FREE ONGKIR SE-INDONESIA DENGAN MIN. BELANJA RP 500.000</span>
                <span class="hidden sm:inline-block text-neutral-500">|</span>
                <span class="hidden sm:inline-block">100% ORIGINAL & BPOM CERTIFIED</span>
                <span class="hidden lg:inline-block text-neutral-500">|</span>
                <span class="hidden lg:inline-block text-luxury-champagne">GRATIS 2 SAMPLE DISCOVERY DI SETIAP PESANAN</span>
            </div>
            <span class="hidden md:inline-block text-neutral-400">IDR (RP)</span>
        </div>
    </div>

    <!-- 2. MAIN HEADER -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-neutral-200 transition-all duration-300">
        <!-- Top Sub-Nav (Sephora Customer Service Bar) -->
        <div class="border-b border-neutral-100 hidden md:block">
            <div class="max-w-7xl mx-auto px-6 py-1.5 flex justify-between items-center text-[11px] text-neutral-500 font-medium">
                <div class="flex items-center space-x-6">
                    <a href="{{ route('atelier') }}" class="hover:text-black transition">TENTANG ATELIER</a>
                    <a href="#olfactory" class="hover:text-black transition">PANDUAN AROMA</a>
                    <a href="{{ route('contact') }}" class="hover:text-black transition">BUTIK KAMI</a>
                </div>
                <div class="flex items-center space-x-6">
                    <span class="flex items-center text-emerald-700"><i class="fa-solid fa-circle-check mr-1 text-[10px]"></i> Garansi Keaslian 100%</span>
                    <a href="{{ route('contact') }}" class="hover:text-black transition"><i class="fa-solid fa-headset mr-1"></i> Bantuan & Konsultasi</a>
                </div>
            </div>
        </div>

        <!-- Main Nav Row -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between gap-4">
            <!-- Mobile Menu Toggle -->
            <button id="mobile-menu-btn" class="md:hidden text-black focus:outline-none p-1">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>

            <!-- Brand Logo (Sephora Clean Luxury Style) -->
            <div class="text-center md:text-left">
                <a href="{{ route('home') }}" class="inline-block group">
                    <h1 class="font-serif-luxury text-2xl md:text-3xl font-bold tracking-[0.2em] text-black group-hover:opacity-80 transition">
                        ZEEN
                    </h1>
                    <span class="block text-[9px] uppercase tracking-[0.35em] text-neutral-500 -mt-1 font-sans">
                        PARFUM • PARIS - JAKARTA
                    </span>
                </a>
            </div>

            <!-- Search Bar (Sephora Wide Rounded Input) -->
            <div class="hidden lg:block flex-1 max-w-md mx-8">
                <form action="{{ route('products.index') }}" method="GET" class="relative">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama parfum, aroma oud, vanilla, atau bunga..."
                           class="w-full bg-neutral-100/80 text-black text-xs placeholder-neutral-500 pl-10 pr-4 py-2.5 rounded-full border border-transparent focus:border-black focus:bg-white focus:outline-none transition-all">
                    <button type="submit" class="absolute left-3.5 top-3 text-neutral-400 hover:text-black">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </button>
                </form>
            </div>

            <!-- Right Actions (Icons: Search, Wishlist, Bag Drawer) -->
            <div class="flex items-center space-x-4 md:space-x-6 text-black">
                <!-- Mobile Search Icon -->
                <button onclick="document.getElementById('mobile-search').classList.toggle('hidden')" class="lg:hidden p-1 text-neutral-700 hover:text-black">
                    <i class="fa-solid fa-magnifying-glass text-lg"></i>
                </button>

                <!-- Member / Beauty Pass perk -->
                <a href="{{ route('atelier') }}" class="hidden sm:flex items-center text-xs font-semibold tracking-wider hover:opacity-75 transition">
                    <i class="fa-regular fa-gem mr-1.5 text-sm text-luxury-gold"></i>
                    <span>ZEEN PRIVÉ</span>
                </a>

                <!-- Shopping Bag Drawer Trigger -->
                @php
                    $sessionCart = session()->get('cart', []);
                    $cartItemCount = array_sum(array_column($sessionCart, 'quantity'));
                @endphp
                <button id="open-cart-btn" class="relative p-1.5 flex items-center hover:opacity-75 transition focus:outline-none">
                    <i class="fa-solid fa-bag-shopping text-xl"></i>
                    <span id="nav-cart-badge" class="{{ $cartItemCount > 0 ? '' : 'hidden' }} absolute -top-1 -right-1 bg-black text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">
                        {{ $cartItemCount }}
                    </span>
                </button>
            </div>
        </div>

        <!-- Mobile Search Dropdown (Hidden by default) -->
        <div id="mobile-search" class="hidden lg:hidden px-4 pb-3 border-t border-neutral-100">
            <form action="{{ route('products.index') }}" method="GET" class="relative mt-2">
                <input type="text" name="q" placeholder="Cari parfum, aroma oud, vanilla..."
                       class="w-full bg-neutral-100 text-black text-xs pl-9 pr-4 py-2 rounded-full border border-neutral-200 focus:outline-none">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-xs text-neutral-400"></i>
            </form>
        </div>

        <!-- 3. MEGA CATEGORY NAVIGATION (Sephora Underline Nav) -->
        <nav class="hidden md:block border-t border-neutral-100">
            <div class="max-w-7xl mx-auto px-6 flex items-center justify-center space-x-8 text-[12px] font-semibold tracking-[0.14em] uppercase text-neutral-800 py-3">
                <a href="{{ route('products.index') }}" class="hover:text-black hover:border-b-2 hover:border-black py-1 transition {{ !request('category') && !request('family') ? 'text-black' : '' }}">
                    SEMUA KOLEKSI
                </a>
                <a href="{{ route('products.index', ['category' => 'extrait-de-parfum']) }}" class="hover:text-black hover:border-b-2 hover:border-black py-1 transition flex items-center">
                    <span>EXTRAIT DE PARFUM</span>
                    <span class="ml-1 text-[9px] bg-black text-white px-1 rounded font-bold">35%</span>
                </a>
                <a href="{{ route('products.index', ['category' => 'eau-de-parfum']) }}" class="hover:text-black hover:border-b-2 hover:border-black py-1 transition">
                    EAU DE PARFUM
                </a>
                <a href="{{ route('products.index', ['category' => 'discovery-sets']) }}" class="hover:text-black hover:border-b-2 hover:border-black py-1 transition">
                    DISCOVERY SETS
                </a>
                <a href="{{ route('products.index', ['category' => 'unisex']) }}" class="hover:text-black hover:border-b-2 hover:border-black py-1 transition">
                    UNISEX
                </a>
                <a href="{{ route('products.index', ['family' => 'Woody']) }}" class="hover:text-black hover:border-b-2 hover:border-black py-1 transition text-neutral-600">
                    WOODY & OUD
                </a>
                <a href="{{ route('products.index', ['family' => 'Floral']) }}" class="hover:text-black hover:border-b-2 hover:border-black py-1 transition text-neutral-600">
                    FLORAL
                </a>
                <a href="{{ route('products.index', ['family' => 'Fresh']) }}" class="hover:text-black hover:border-b-2 hover:border-black py-1 transition text-neutral-600">
                    FRESH
                </a>
            </div>
        </nav>
    </header>

    <!-- MOBILE MENU DRAWER -->
    <div id="mobile-menu-drawer" class="fixed inset-0 z-50 transform -translate-x-full transition-transform duration-300 md:hidden flex">
        <div class="w-4/5 max-w-sm bg-white h-full shadow-2xl flex flex-col p-6 z-10 overflow-y-auto">
            <div class="flex items-center justify-between pb-4 border-b border-neutral-200">
                <div class="font-serif-luxury text-xl font-bold tracking-widest">ZEEN PARFUM</div>
                <button id="close-mobile-menu" class="text-neutral-500 hover:text-black text-lg p-1">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="py-4 space-y-4 text-xs uppercase tracking-widest font-semibold">
                <a href="{{ route('products.index') }}" class="block py-2 border-b border-neutral-100">Semua Koleksi</a>
                <a href="{{ route('products.index', ['category' => 'extrait-de-parfum']) }}" class="block py-2 border-b border-neutral-100">Extrait de Parfum (35%)</a>
                <a href="{{ route('products.index', ['category' => 'eau-de-parfum']) }}" class="block py-2 border-b border-neutral-100">Eau de Parfum</a>
                <a href="{{ route('products.index', ['category' => 'discovery-sets']) }}" class="block py-2 border-b border-neutral-100">Discovery Sets</a>
                <a href="{{ route('products.index', ['category' => 'unisex']) }}" class="block py-2 border-b border-neutral-100">Unisex Collection</a>
                <a href="{{ route('atelier') }}" class="block py-2 border-b border-neutral-100">Tentang Atelier ZEEN</a>
                <a href="{{ route('contact') }}" class="block py-2">Kontak & Butik</a>
            </div>
            <div class="mt-auto pt-6 border-t border-neutral-200 text-xs text-neutral-500 space-y-2">
                <p>Konsultasi Parfum Gratis via WhatsApp:</p>
                <a href="https://wa.me/6281234567890?text=Halo%20ZEEN%20PARFUM%2C%20saya%20ingin%20rekomendasi%20parfum" target="_blank"
                   class="flex items-center justify-center space-x-2 bg-emerald-600 text-white py-2.5 rounded font-bold uppercase tracking-wider text-[11px]">
                    <i class="fa-brands fa-whatsapp text-sm"></i>
                    <span>CHAT FRAGRANCE EXPERT</span>
                </a>
            </div>
        </div>
        <div id="mobile-menu-overlay" class="flex-1 bg-black/60"></div>
    </div>

    <!-- FLASH MESSAGES -->
    @if(session('success'))
        <div class="bg-black text-white text-xs px-4 py-3 text-center flex items-center justify-center space-x-2 border-b border-neutral-700 animate-fadeIn">
            <i class="fa-solid fa-circle-check text-emerald-400"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-900 text-white text-xs px-4 py-3 text-center flex items-center justify-center space-x-2 border-b border-red-700">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- MAIN CONTENT -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- 4. LUXURY SEPHORA-STYLE FOOTER -->
    <footer class="bg-black text-white pt-16 pb-12 border-t border-neutral-900 mt-20">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Newsletter Ticker Bar (Sephora Signature 10% Off perk) -->
            <div class="bg-neutral-950 border border-neutral-800 p-8 md:p-10 mb-16 text-center max-w-4xl mx-auto">
                <span class="text-luxury-gold text-xs font-semibold uppercase tracking-[0.25em] block mb-2">ZEEN PRIVILEGE CLUB</span>
                <h3 class="font-serif-luxury text-2xl md:text-3xl font-normal mb-3">Dapatkan Hak Istimewa & Potongan Rp 100.000</h3>
                <p class="text-neutral-400 text-xs max-w-md mx-auto mb-6">Daftarkan email Anda untuk undangan rilis terbatas, private preview aroma baru, dan reward keanggotaan eksklusif.</p>
                <form onsubmit="event.preventDefault(); alert('Terima kasih! Kode voucher PRIVILEGE100 telah dikirim ke email Anda.');" class="flex flex-col sm:flex-row max-w-md mx-auto gap-2">
                    <input type="email" required placeholder="Masukkan alamat email Anda"
                           class="flex-1 bg-neutral-900 border border-neutral-700 text-white text-xs px-4 py-3 focus:outline-none focus:border-white">
                    <button type="submit" class="bg-white text-black text-xs font-bold uppercase tracking-widest px-6 py-3 hover:bg-neutral-200 transition">
                        GABUNG SEKARANG
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-neutral-800 text-xs">
                <!-- Col 1: Brand Info -->
                <div class="space-y-4">
                    <h4 class="font-serif-luxury text-lg font-bold tracking-widest text-white">ZEEN PARFUM</h4>
                    <p class="text-neutral-400 leading-relaxed font-light text-[12px]">
                        Atelier parfum niche independen yang memadukan keanggunan seni wewangian Prancis dengan kekayaan rempah alami Nusantara. Diformulasikan dengan konsentrasi murni Extrait de Parfum 35%.
                    </p>
                    <div class="flex items-center space-x-4 text-neutral-400 text-base pt-2">
                        <a href="#" class="hover:text-white transition"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="hover:text-white transition"><i class="fa-brands fa-tiktok"></i></a>
                        <a href="#" class="hover:text-white transition"><i class="fa-brands fa-youtube"></i></a>
                        <a href="#" class="hover:text-white transition"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>

                <!-- Col 2: Olfactory Collections -->
                <div>
                    <h5 class="font-bold uppercase tracking-widest text-neutral-300 mb-4 text-[11px]">Koleksi Mahakarya</h5>
                    <ul class="space-y-2.5 text-neutral-400 font-light">
                        <li><a href="{{ route('products.index', ['category' => 'extrait-de-parfum']) }}" class="hover:text-white transition">Extrait de Parfum (35%)</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'eau-de-parfum']) }}" class="hover:text-white transition">Eau de Parfum</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'discovery-sets']) }}" class="hover:text-white transition">Discovery Travel Sets</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'unisex']) }}" class="hover:text-white transition">Unisex Fragrances</a></li>
                        <li><a href="{{ route('products.index', ['family' => 'Woody']) }}" class="hover:text-white transition">Woody & Oud Family</a></li>
                    </ul>
                </div>

                <!-- Col 3: Customer Care -->
                <div>
                    <h5 class="font-bold uppercase tracking-widest text-neutral-300 mb-4 text-[11px]">Layanan Pelanggan</h5>
                    <ul class="space-y-2.5 text-neutral-400 font-light">
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition">Lacak Pesanan</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition">Kebijakan Pengiriman & Free Ongkir</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition">Jaminan 100% Produk Asli</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition">Konsultasi Aroma Pribadi</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition">Pertanyaan Umum (FAQ)</a></li>
                    </ul>
                </div>

                <!-- Col 4: Payment & Security Assurance -->
                <div>
                    <h5 class="font-bold uppercase tracking-widest text-neutral-300 mb-4 text-[11px]">Metode Pembayaran Resmi</h5>
                    <p class="text-neutral-400 font-light mb-3">Mendukung pembayaran digital instan QRIS dan Transfer Bank aman:</p>
                    <div class="grid grid-cols-3 gap-2 text-center text-neutral-400 text-[11px]">
                        <div class="bg-neutral-900 border border-neutral-800 p-2 font-bold text-white rounded">QRIS</div>
                        <div class="bg-neutral-900 border border-neutral-800 p-2 font-bold text-white rounded">BCA</div>
                        <div class="bg-neutral-900 border border-neutral-800 p-2 font-bold text-white rounded">MANDIRI</div>
                        <div class="bg-neutral-900 border border-neutral-800 p-2 font-bold text-white rounded">BNI</div>
                        <div class="bg-neutral-900 border border-neutral-800 p-2 font-bold text-white rounded">BRI</div>
                        <div class="bg-neutral-900 border border-neutral-800 p-2 font-bold text-white rounded">GOPAY</div>
                    </div>
                    <div class="mt-4 flex items-center text-emerald-400 text-[11px]">
                        <i class="fa-solid fa-lock mr-1.5"></i>
                        <span>Enkripsi SSL 256-Bit Aman</span>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright & BPOM Badge -->
            <div class="pt-8 flex flex-col md:flex-row items-center justify-between text-neutral-500 text-[11px]">
                <p>&copy; {{ date('Y') }} ZEEN PARFUM INDONESIA. Hak Cipta Dilindungi Undang-Undang. • <a href="{{ route('admin.dashboard') }}" class="hover:text-neutral-300 underline underline-offset-4 decoration-neutral-700 transition">Atelier CMS</a></p>
                <div class="flex items-center space-x-6 mt-4 md:mt-0">
                    <span>Terdaftar BPOM RI</span>
                    <span>Cruelty-Free</span>
                    <span>IFRA Certified Ingredients</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- 5. SLIDE-OUT MINI CART DRAWER (Sephora Signature Side Drawer) -->
    <div id="cart-drawer-container" class="fixed inset-0 z-50 pointer-events-none transition-opacity duration-300 opacity-0">
        <!-- Backdrop -->
        <div id="cart-drawer-backdrop" class="absolute inset-0 bg-black/60 pointer-events-auto"></div>

        <!-- Slide Panel -->
        <div id="cart-drawer-panel" class="absolute right-0 top-0 bottom-0 w-full max-w-md bg-white shadow-2xl pointer-events-auto transform translate-x-full transition-transform duration-300 flex flex-col">
            <!-- Drawer Header -->
            <div class="px-6 py-4 border-b border-neutral-200 flex items-center justify-between bg-neutral-50">
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-bag-shopping text-base text-black"></i>
                    <h3 class="font-serif-luxury text-base font-bold tracking-wider text-black">TAS BELANJA SAYA</h3>
                    <span id="drawer-cart-count" class="text-xs bg-black text-white px-2 py-0.5 rounded-full font-sans">0</span>
                </div>
                <button id="close-cart-btn" class="text-neutral-500 hover:text-black p-1 text-lg">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Free Ongkir Progress Bar in Drawer -->
            <div class="bg-black text-white px-6 py-2.5 text-[11px]">
                <div id="drawer-shipping-text" class="flex items-center justify-between font-medium">
                    <span>Belanja Min. Rp 500.000 untuk FREE ONGKIR</span>
                    <i class="fa-solid fa-truck-fast"></i>
                </div>
            </div>

            <!-- Cart Items List -->
            <div id="drawer-cart-items" class="flex-1 overflow-y-auto p-6 space-y-4 divide-y divide-neutral-100">
                <!-- Dynamically loaded via JavaScript -->
                <div class="text-center py-16 text-neutral-400">
                    <i class="fa-solid fa-bag-shopping text-4xl mb-3 text-neutral-200"></i>
                    <p class="text-xs">Tas belanja Anda masih kosong</p>
                </div>
            </div>

            <!-- Drawer Footer / Checkout CTA -->
            <div class="p-6 border-t border-neutral-200 bg-neutral-50 space-y-3">
                <div class="flex items-center justify-between text-xs text-neutral-500">
                    <span>Estimasi Subtotal</span>
                    <span id="drawer-cart-subtotal" class="text-sm font-bold text-black font-sans">Rp 0</span>
                </div>
                <div class="text-[11px] text-neutral-400">Pajak & ongkir dihitung saat tahap checkout.</div>
                
                <div class="space-y-2 pt-2">
                    <a href="{{ route('checkout.index') }}" class="w-full bg-black text-white text-xs font-bold uppercase tracking-widest py-3.5 flex items-center justify-center space-x-2 hover:bg-neutral-800 transition">
                        <span>LANJUT KE PEMBAYARAN</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                    <a href="{{ route('cart.index') }}" class="w-full bg-white border border-neutral-300 text-black text-xs font-bold uppercase tracking-widest py-2.5 flex items-center justify-center hover:bg-neutral-100 transition">
                        <span>LIHAT TAS BELANJA LENGKAP</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- FLOATING WHATSAPP ASSISTANT -->
    <a href="https://wa.me/6281234567890?text=Halo%20ZEEN%20PARFUM%2C%20saya%20tertarik%20dengan%20koleksi%20parfum%20ini" target="_blank"
       class="fixed bottom-6 right-6 z-30 bg-black text-white hover:bg-emerald-600 transition-all duration-300 p-3.5 rounded-full shadow-2xl flex items-center space-x-2 group">
        <i class="fa-brands fa-whatsapp text-2xl text-emerald-400 group-hover:text-white transition"></i>
        <span class="text-xs font-semibold uppercase tracking-wider pr-2 hidden sm:inline-block">Konsultasi Aroma</span>
    </a>

    <!-- SCRIPTS FOR CART DRAWER & AJAX INTERACTIONS -->
    <script>
        const cartDrawer = document.getElementById('cart-drawer-container');
        const cartPanel = document.getElementById('cart-drawer-panel');
        const openCartBtn = document.getElementById('open-cart-btn');
        const closeCartBtn = document.getElementById('close-cart-btn');
        const cartBackdrop = document.getElementById('cart-drawer-backdrop');
        const navCartBadge = document.getElementById('nav-cart-badge');
        const drawerCartCount = document.getElementById('drawer-cart-count');
        const drawerCartSubtotal = document.getElementById('drawer-cart-subtotal');
        const drawerCartItems = document.getElementById('drawer-cart-items');

        function openDrawer() {
            cartDrawer.classList.remove('opacity-0', 'pointer-events-none');
            cartPanel.classList.remove('translate-x-full');
            loadDrawerCart();
        }

        function closeDrawer() {
            cartDrawer.classList.add('opacity-0', 'pointer-events-none');
            cartPanel.classList.add('translate-x-full');
        }

        if (openCartBtn) openCartBtn.addEventListener('click', openDrawer);
        if (closeCartBtn) closeCartBtn.addEventListener('click', closeDrawer);
        if (cartBackdrop) cartBackdrop.addEventListener('click', closeDrawer);

        // Mobile Menu
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const closeMobileMenu = document.getElementById('close-mobile-menu');
        const mobileMenuDrawer = document.getElementById('mobile-menu-drawer');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenuDrawer.classList.remove('-translate-x-full');
            });
        }
        if (closeMobileMenu) {
            closeMobileMenu.addEventListener('click', () => {
                mobileMenuDrawer.classList.add('-translate-x-full');
            });
        }
        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', () => {
                mobileMenuDrawer.classList.add('-translate-x-full');
            });
        }

        // Load Drawer Cart data
        async function loadDrawerCart() {
            try {
                const res = await fetch("{{ route('cart.mini') }}");
                const data = await res.json();
                
                drawerCartCount.textContent = data.count;
                if (navCartBadge) {
                    navCartBadge.textContent = data.count;
                    if (data.count > 0) navCartBadge.classList.remove('hidden');
                    else navCartBadge.classList.add('hidden');
                }
                drawerCartSubtotal.textContent = data.subtotal;

                if (data.items.length === 0) {
                    drawerCartItems.innerHTML = `
                        <div class="text-center py-16 text-neutral-400">
                            <i class="fa-solid fa-bag-shopping text-4xl mb-3 text-neutral-200"></i>
                            <p class="text-xs">Tas belanja Anda masih kosong</p>
                            <a href="{{ route('products.index') }}" class="inline-block mt-4 text-xs font-bold underline text-black">Mulai Belanja</a>
                        </div>
                    `;
                } else {
                    let html = '';
                    data.items.forEach(item => {
                        const priceFormatted = 'Rp ' + Number(item.price).toLocaleString('id-ID');
                        html += `
                            <div class="flex items-center space-x-4 pt-3 first:pt-0">
                                <img src="${item.image}" alt="${item.name}" class="w-16 h-20 object-cover rounded bg-neutral-100 flex-shrink-0">
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-serif-luxury font-bold text-xs truncate">${item.name}</h4>
                                    <p class="text-[10px] text-neutral-500 uppercase tracking-wider">${item.concentration} • ${item.size}</p>
                                    <div class="text-xs font-semibold text-black mt-1">${priceFormatted}</div>
                                    <div class="flex items-center justify-between mt-2">
                                        <span class="text-[11px] text-neutral-500">Qty: ${item.quantity}</span>
                                        <button onclick="removeFromCart('${item.id}')" class="text-[11px] text-red-500 hover:text-red-700 underline">Hapus</button>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    drawerCartItems.innerHTML = html;
                }
            } catch (err) {
                console.error('Failed to load cart', err);
            }
        }

        // Global Add To Bag Helper
        async function quickAddToCart(productId, size = '50ml', quantity = 1) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            try {
                const res = await fetch("{{ route('cart.add') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ product_id: productId, size: size, quantity: quantity })
                });
                const data = await res.json();
                if (data.success) {
                    openDrawer();
                }
            } catch (e) {
                console.error(e);
            }
        }

        // Global Remove From Cart Helper
        async function removeFromCart(cartId) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            try {
                await fetch("{{ route('cart.remove') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ id: cartId })
                });
                loadDrawerCart();
            } catch (e) {
                console.error(e);
            }
        }
    </script>
    @stack('scripts')
</body>
</html>

