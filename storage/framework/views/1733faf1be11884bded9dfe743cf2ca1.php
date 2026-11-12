<?php $__env->startSection('title', 'ZEEN PARFUM | Luxury Haute Parfumerie & Extrait de Parfum'); ?>

<?php $__env->startSection('content'); ?>

<!-- 1. EDITORIAL HERO BANNER (Sephora Full-bleed Luxury Carousel) -->
<section class="relative bg-black text-white overflow-hidden min-h-[580px] md:min-h-[680px] flex items-center">
    <!-- Background Image with Gradient Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?auto=format&fit=crop&w=2000&q=90"
             alt="ZEEN PARFUM NOIR ABSOLU"
             class="w-full h-full object-cover object-center scale-105 transform hover:scale-100 transition-all duration-1000 opacity-60">
        <div class="absolute inset-0 bg-gradient-to-r from-black via-black/70 to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 py-20 w-full">
        <div class="max-w-xl space-y-6">
            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md border border-white/20 px-3.5 py-1 text-[10px] tracking-[0.25em] uppercase font-semibold text-luxury-champagne">
                <i class="fa-solid fa-sparkles text-xs"></i>
                <span>NEW ARRIVAL • EXTRAIT DE PARFUM 35%</span>
            </div>

            <!-- Title -->
            <h2 class="font-serif-luxury text-4xl sm:text-6xl lg:text-7xl font-bold tracking-tight leading-[1.05]">
                NOIR <br><span class="italic font-normal font-serif">ABSOLU</span>
            </h2>

            <!-- Minimal Subtitle -->
            <p class="text-neutral-300 text-sm sm:text-base font-light tracking-wide max-w-md">
                Keanggunan kayu oud langka, kehangatan Madagascar bourbon vanilla, dan sentuhan ambergris magnetis. Ketahanan 16+ jam.
            </p>

            <!-- Buttons -->
            <div class="flex flex-wrap items-center gap-4 pt-4">
                <a href="<?php echo e(route('products.show', 'noir-absolu')); ?>"
                   class="bg-white text-black hover:bg-neutral-200 transition px-8 py-3.5 text-xs font-bold uppercase tracking-widest flex items-center space-x-2">
                    <span>EKSPLORASI AROMA</span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
                <button onclick="quickAddToCart(<?php echo e($spotlightProduct->id ?? 1); ?>)"
                        class="bg-transparent border border-white/80 hover:bg-white hover:text-black transition text-white px-7 py-3.5 text-xs font-bold uppercase tracking-widest flex items-center space-x-2">
                    <i class="fa-solid fa-bag-shopping text-xs"></i>
                    <span>TAMBAH KE TAS • RP 785.000</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Bottom Indicator Pills -->
    <div class="absolute bottom-6 left-0 right-0 z-10">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-between text-[11px] text-neutral-400">
            <div class="flex items-center space-x-3">
                <span class="w-8 h-0.5 bg-white"></span>
                <span class="w-8 h-0.5 bg-white/30"></span>
                <span class="w-8 h-0.5 bg-white/30"></span>
            </div>
            <span class="tracking-widest uppercase text-[10px]">01 / 03 • PRIVATE COLLECTION</span>
        </div>
    </div>
</section>

<!-- 2. LUXURY TRUST BADGES (Sephora Signature Strip) -->
<section class="border-b border-neutral-200 bg-neutral-50/80 py-6">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="flex items-center justify-center space-x-3 text-left">
                <i class="fa-solid fa-box-check text-2xl text-black"></i>
                <div>
                    <div class="text-xs font-bold uppercase tracking-wider text-black">100% ORIGINAL & BPOM</div>
                    <div class="text-[11px] text-neutral-500">Sertifikasi IFRA resmi</div>
                </div>
            </div>
            <div class="flex items-center justify-center space-x-3 text-left">
                <i class="fa-solid fa-truck-fast text-2xl text-black"></i>
                <div>
                    <div class="text-xs font-bold uppercase tracking-wider text-black">FREE ONGKIR EXPRESS</div>
                    <div class="text-[11px] text-neutral-500">Min. transaksi Rp 500.000</div>
                </div>
            </div>
            <div class="flex items-center justify-center space-x-3 text-left">
                <i class="fa-solid fa-vial-circle-check text-2xl text-black"></i>
                <div>
                    <div class="text-xs font-bold uppercase tracking-wider text-black">GRATIS 2 SAMPLE VIAL</div>
                    <div class="text-[11px] text-neutral-500">Di setiap paket pesanan</div>
                </div>
            </div>
            <div class="flex items-center justify-center space-x-3 text-left">
                <i class="fa-solid fa-shield-halved text-2xl text-black"></i>
                <div>
                    <div class="text-xs font-bold uppercase tracking-wider text-black">PEMBAYARAN INSTAN</div>
                    <div class="text-[11px] text-neutral-500">QRIS & Transfer Bank Otomatis</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. SHOP BY OLFACTORY FAMILY (Visual Category Tiles, Minim Tulisan Banyak Gambar) -->
<section id="olfactory" class="py-16 md:py-24 max-w-7xl mx-auto px-6">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 pb-4 border-b border-black">
        <div>
            <span class="text-[10px] uppercase tracking-[0.25em] text-neutral-500 block mb-1 font-semibold">FAMILLE OLFACTIVE</span>
            <h3 class="font-serif-luxury text-2xl md:text-4xl font-bold tracking-tight">EKSPLORASI KARAKTER AROMA</h3>
        </div>
        <a href="<?php echo e(route('products.index')); ?>" class="mt-4 md:mt-0 text-xs font-bold uppercase tracking-widest text-black hover:opacity-70 flex items-center space-x-1">
            <span>SEMUA KATEGORI</span>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
        </a>
    </div>

    <!-- Visual Category Grid (Minimal text, heavy visual allure) -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
        <!-- Tile 1: Woody & Oud -->
        <a href="<?php echo e(route('products.index', ['family' => 'Woody'])); ?>" class="group relative overflow-hidden aspect-[3/4] bg-neutral-900 block">
            <img src="https://images.unsplash.com/photo-1547887537-6158d64c35b3?auto=format&fit=crop&w=800&q=80"
                 alt="Woody & Oud"
                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-85">
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent flex flex-col justify-end p-5">
                <span class="text-[10px] uppercase tracking-[0.2em] text-luxury-champagne font-semibold mb-1">01 • KAYU & OUD</span>
                <h4 class="font-serif-luxury text-xl font-bold text-white tracking-wide">WOODY & OUD</h4>
                <p class="text-[11px] text-neutral-300 font-light mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    Sandalwood, cedar, smoked agarwood
                </p>
            </div>
        </a>

        <!-- Tile 2: Warm Amber & Gourmand -->
        <a href="<?php echo e(route('products.index', ['family' => 'Amber'])); ?>" class="group relative overflow-hidden aspect-[3/4] bg-neutral-900 block">
            <img src="https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?auto=format&fit=crop&w=800&q=80"
                 alt="Amber & Vanilla"
                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-85">
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent flex flex-col justify-end p-5">
                <span class="text-[10px] uppercase tracking-[0.2em] text-luxury-champagne font-semibold mb-1">02 • HANGAT & MANIS</span>
                <h4 class="font-serif-luxury text-xl font-bold text-white tracking-wide">AMBER & VANILLA</h4>
                <p class="text-[11px] text-neutral-300 font-light mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    Bourbon vanilla, tonka bean, saffron
                </p>
            </div>
        </a>

        <!-- Tile 3: Floral & Solar -->
        <a href="<?php echo e(route('products.index', ['family' => 'Floral'])); ?>" class="group relative overflow-hidden aspect-[3/4] bg-neutral-900 block">
            <img src="https://images.unsplash.com/photo-1588405748880-12d1d2a59f75?auto=format&fit=crop&w=800&q=80"
                 alt="Floral & Solar"
                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-85">
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent flex flex-col justify-end p-5">
                <span class="text-[10px] uppercase tracking-[0.2em] text-luxury-champagne font-semibold mb-1">03 • BUNGA & MAWAR</span>
                <h4 class="font-serif-luxury text-xl font-bold text-white tracking-wide">FLORAL & SOLAR</h4>
                <p class="text-[11px] text-neutral-300 font-light mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    Grasse jasmine, Turkish rose, neroli
                </p>
            </div>
        </a>

        <!-- Tile 4: Fresh & Marine -->
        <a href="<?php echo e(route('products.index', ['family' => 'Fresh'])); ?>" class="group relative overflow-hidden aspect-[3/4] bg-neutral-900 block">
            <img src="https://images.unsplash.com/photo-1594035910387-fea47794261f?auto=format&fit=crop&w=800&q=80"
                 alt="Fresh & Aquatic"
                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-85">
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent flex flex-col justify-end p-5">
                <span class="text-[10px] uppercase tracking-[0.2em] text-luxury-champagne font-semibold mb-1">04 • SEGAR & MINERAL</span>
                <h4 class="font-serif-luxury text-xl font-bold text-white tracking-wide">FRESH & AQUATIC</h4>
                <p class="text-[11px] text-neutral-300 font-light mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    Calabrian bergamot, sea salt, driftwood
                </p>
            </div>
        </a>
    </div>
</section>

<!-- 4. TRENDING NOW / BESTSELLERS (Sephora Signature Product Grid) -->
<section class="py-12 bg-white max-w-7xl mx-auto px-6">
    <div class="flex items-center justify-between mb-8 pb-3 border-b border-neutral-200">
        <div>
            <span class="text-[10px] uppercase tracking-[0.25em] text-neutral-500 font-semibold">LES BEST-SELLERS</span>
            <h3 class="font-serif-luxury text-2xl md:text-3xl font-bold tracking-tight">PRODUK TERLARIS MINGGU INI</h3>
        </div>
        <a href="<?php echo e(route('products.index', ['sort' => 'bestseller'])); ?>" class="text-xs font-bold uppercase tracking-widest text-black hover:opacity-75">
            LIHAT SEMUA (<?php echo e($featuredProducts->count()); ?>)
        </a>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-8">
        <?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="group flex flex-col justify-between border border-neutral-100 hover:border-black p-3 md:p-4 transition-all duration-300 relative bg-white">
                <!-- Badges (BESTSELLER / NEW) -->
                <?php if($item->badge): ?>
                    <div class="absolute top-5 left-5 z-10 bg-black text-white text-[9px] font-bold uppercase tracking-widest px-2.5 py-1">
                        <?php echo e($item->badge); ?>

                    </div>
                <?php endif; ?>

                <!-- Wishlist heart button -->
                <button onclick="this.classList.toggle('text-red-500')" class="absolute top-5 right-5 z-10 text-neutral-300 hover:text-red-500 transition p-1">
                    <i class="fa-solid fa-heart text-sm"></i>
                </button>

                <!-- Product Image (Aspect 1:1.15) -->
                <a href="<?php echo e(route('products.show', $item->slug)); ?>" class="block overflow-hidden aspect-[4/5] bg-neutral-50 mb-4 relative">
                    <img src="<?php echo e($item->image); ?>"
                         alt="<?php echo e($item->name); ?>"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </a>

                <!-- Product Info (Clean Sephora Typography) -->
                <div class="space-y-1.5 flex-1 flex flex-col">
                    <div class="text-[10px] uppercase tracking-wider text-neutral-500 font-semibold">
                        <?php echo e($item->concentration); ?>

                    </div>
                    <a href="<?php echo e(route('products.show', $item->slug)); ?>" class="block font-serif-luxury text-base font-bold text-black group-hover:opacity-70 transition leading-snug">
                        <?php echo e($item->name); ?>

                    </a>
                    <p class="text-[11px] text-neutral-500 line-clamp-1 font-light"><?php echo e($item->subtitle); ?></p>

                    <!-- Rating Stars -->
                    <div class="flex items-center space-x-1 pt-1 text-[11px]">
                        <div class="text-luxury-gold flex text-[10px]">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <span class="text-neutral-500 text-[10px]">(<?php echo e($item->reviews_count); ?>)</span>
                    </div>

                    <!-- Price -->
                    <div class="pt-2 flex items-baseline space-x-2 mt-auto">
                        <span class="font-bold text-sm md:text-base text-black font-sans"><?php echo e($item->formatted_price); ?></span>
                        <?php if($item->original_price): ?>
                            <span class="text-xs text-neutral-400 line-through"><?php echo e($item->formatted_original_price); ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Quick Add To Bag Button -->
                <div class="mt-4 pt-3 border-t border-neutral-100">
                    <button onclick="quickAddToCart(<?php echo e($item->id); ?>)"
                            class="w-full bg-black hover:bg-neutral-800 text-white text-[11px] font-bold uppercase tracking-wider py-2.5 flex items-center justify-center space-x-2 transition">
                        <i class="fa-solid fa-bag-shopping text-xs"></i>
                        <span>TAMBAH KE TAS</span>
                    </button>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>

<!-- 5. EDITORIAL SPOTLIGHT: OLFACTORY PYRAMID BREAKDOWN -->
<section class="my-16 bg-neutral-950 text-white py-20 border-y border-neutral-900">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left Large Image Visual -->
            <div class="lg:col-span-5 relative">
                <div class="aspect-[3/4] overflow-hidden bg-neutral-900 relative">
                    <img src="https://images.unsplash.com/photo-1523293182086-7651a899d37f?auto=format&fit=crop&w=1000&q=85"
                         alt="ZEEN SANTAL IMPÉRIAL"
                         class="w-full h-full object-cover">
                    <div class="absolute bottom-4 left-4 bg-black/80 backdrop-blur-md px-4 py-2 border border-white/20 text-[10px] tracking-widest uppercase">
                        ATELIER PRIVÉ • BOTANICAL EXTRACT
                    </div>
                </div>
            </div>

            <!-- Right: Scent Notes Breakdown (Visual Pyramid) -->
            <div class="lg:col-span-7 space-y-8">
                <div>
                    <span class="text-luxury-champagne text-[10px] font-semibold tracking-[0.25em] uppercase block mb-2">ANATOMI AROMA • HAUTE PARFUMERIE</span>
                    <h3 class="font-serif-luxury text-3xl md:text-5xl font-bold leading-tight">
                        SANTAL <span class="font-light italic font-serif">IMPÉRIAL</span>
                    </h3>
                    <p class="text-neutral-400 text-xs sm:text-sm font-light mt-3 max-w-xl leading-relaxed">
                        Diformulasikan selama 14 bulan di Grasse, Prancis. Perpaduan sandalwood Australia yang creamy, bubuk iris Florentine, dan amber putih murni.
                    </p>
                </div>

                <!-- 3 Scent Pyramid Visual Cards -->
                <div class="space-y-4">
                    <!-- Top Notes -->
                    <div class="bg-neutral-900/80 border border-neutral-800 p-4 flex items-start space-x-4">
                        <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-luxury-gold flex-shrink-0 font-serif-luxury font-bold text-sm">
                            T
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between text-xs">
                                <span class="font-bold uppercase tracking-widest text-white">TOP NOTES (0 - 30 MENIT)</span>
                                <span class="text-neutral-400 text-[10px]">Kesan Pertama</span>
                            </div>
                            <p class="text-xs text-neutral-300 mt-1 font-light">Australian Sandalwood, Cardamom Guatemala, Papyrus Mesir</p>
                        </div>
                    </div>

                    <!-- Heart Notes -->
                    <div class="bg-neutral-900/80 border border-neutral-800 p-4 flex items-start space-x-4">
                        <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-luxury-gold flex-shrink-0 font-serif-luxury font-bold text-sm">
                            H
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between text-xs">
                                <span class="font-bold uppercase tracking-widest text-white">HEART NOTES (30 MNT - 4 JAM)</span>
                                <span class="text-neutral-400 text-[10px]">Jiwa Parfum</span>
                            </div>
                            <p class="text-xs text-neutral-300 mt-1 font-light">Violet Leaves, Tuscan Iris Butter, Virginia Cedarwood</p>
                        </div>
                    </div>

                    <!-- Base Notes -->
                    <div class="bg-neutral-900/80 border border-neutral-800 p-4 flex items-start space-x-4">
                        <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-luxury-gold flex-shrink-0 font-serif-luxury font-bold text-sm">
                            B
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between text-xs">
                                <span class="font-bold uppercase tracking-widest text-white">BASE NOTES (4 - 18 JAM)</span>
                                <span class="text-neutral-400 text-[10px]">Aroma Menetap</span>
                            </div>
                            <p class="text-xs text-neutral-300 mt-1 font-light">White Amber, Clean Leather Accord, Cashmere Musk</p>
                        </div>
                    </div>
                </div>

                <!-- Longevity Gauge Meter -->
                <div class="grid grid-cols-2 gap-4 pt-2">
                    <div class="bg-neutral-900 p-4 border border-neutral-800">
                        <div class="text-[10px] uppercase tracking-wider text-neutral-400 mb-1">KETAHANAN (LONGEVITY)</div>
                        <div class="text-base font-bold text-white flex items-center space-x-2">
                            <span>14 - 18 Jam</span>
                            <span class="text-emerald-400 text-xs"><i class="fa-solid fa-bolt"></i> Extra Long</span>
                        </div>
                        <div class="w-full bg-neutral-800 h-1 mt-2">
                            <div class="bg-luxury-gold h-1 w-[92%]"></div>
                        </div>
                    </div>
                    <div class="bg-neutral-900 p-4 border border-neutral-800">
                        <div class="text-[10px] uppercase tracking-wider text-neutral-400 mb-1">JEJAK AROMA (SILLAGE)</div>
                        <div class="text-base font-bold text-white flex items-center space-x-2">
                            <span>Intense Radiance</span>
                            <span class="text-luxury-champagne text-xs"><i class="fa-solid fa-wind"></i> 2 Meter</span>
                        </div>
                        <div class="w-full bg-neutral-800 h-1 mt-2">
                            <div class="bg-luxury-gold h-1 w-[85%]"></div>
                        </div>
                    </div>
                </div>

                <!-- CTA -->
                <div class="pt-2">
                    <a href="<?php echo e(route('products.show', 'santal-imperial')); ?>"
                       class="inline-block bg-white text-black hover:bg-neutral-200 transition text-xs font-bold uppercase tracking-widest px-8 py-3.5">
                        MILIKI SANTAL IMPÉRIAL • RP 745.000
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 6. DISCOVERY SET HERO SPOTLIGHT (Must-have Entry Product) -->
<section class="max-w-7xl mx-auto px-6 py-12">
    <div class="bg-neutral-100 border border-neutral-200 p-8 md:p-14 flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="max-w-lg space-y-4">
            <span class="text-xs uppercase tracking-[0.2em] font-bold text-neutral-500">PENASARAN INGIN MENCOBA SEMUA AROMA?</span>
            <h3 class="font-serif-luxury text-3xl md:text-4xl font-bold text-black leading-tight">
                THE SIGNATURE DISCOVERY BOX
            </h3>
            <p class="text-neutral-600 text-xs sm:text-sm font-light leading-relaxed">
                Dapatkan 5 miniature travel vial (5ml) dari seluruh koleksi mahakarya ZEEN dalam kotak beludru hitam eksklusif. Termasuk Voucher Diskon Rp 100.000 untuk pembelian full bottle berikutnya.
            </p>
            <div class="pt-2 flex items-center space-x-4">
                <button onclick="quickAddToCart(6, '5 x 5ml')"
                        class="bg-black text-white hover:bg-neutral-800 transition text-xs font-bold uppercase tracking-widest px-8 py-3.5 flex items-center space-x-2">
                    <i class="fa-solid fa-bag-shopping text-xs"></i>
                    <span>BELI DISCOVERY SET • RP 385.000</span>
                </button>
                <a href="<?php echo e(route('products.show', 'the-signature-discovery-box')); ?>" class="text-xs font-bold underline uppercase tracking-wider text-black">
                    DETAIL ISI BOX
                </a>
            </div>
        </div>

        <div class="w-full md:w-1/2 max-w-md aspect-square overflow-hidden bg-white shadow-xl relative">
            <img src="https://images.unsplash.com/photo-1616949755610-8c9bbc08f138?auto=format&fit=crop&w=800&q=85"
                 alt="ZEEN DISCOVERY BOX"
                 class="w-full h-full object-cover">
            <div class="absolute top-4 right-4 bg-black text-white text-[9px] font-bold px-3 py-1 uppercase tracking-widest">
                FREE VOUCHER RP 100K
            </div>
        </div>
    </div>
</section>

<!-- 7. INSTAGRAM / EDITORIAL GALLERY (#ZEENMOMENTS) -->
<section class="py-16 max-w-7xl mx-auto px-6">
    <div class="text-center mb-10">
        <span class="text-[10px] uppercase tracking-[0.25em] text-neutral-500 font-semibold block mb-1">KOMUNITAS PECINTA AROMA</span>
        <h3 class="font-serif-luxury text-2xl md:text-3xl font-bold tracking-tight">#ZEENMOMENTS PADA INSTAGRAM</h3>
        <p class="text-xs text-neutral-500 mt-2 font-light">Tag @zeenparfum pada cerita aroma harian Anda untuk ditampilkan di galeri resmi kami.</p>
    </div>

    <!-- 5 Clean Visual Tiles -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
        <div class="aspect-square bg-neutral-100 overflow-hidden relative group">
            <img src="https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?auto=format&fit=crop&w=600&q=80" alt="Instagram 1" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-white text-xl">
                <i class="fa-brands fa-instagram"></i>
            </div>
        </div>
        <div class="aspect-square bg-neutral-100 overflow-hidden relative group">
            <img src="https://images.unsplash.com/photo-1547887537-6158d64c35b3?auto=format&fit=crop&w=600&q=80" alt="Instagram 2" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-white text-xl">
                <i class="fa-brands fa-instagram"></i>
            </div>
        </div>
        <div class="aspect-square bg-neutral-100 overflow-hidden relative group">
            <img src="https://images.unsplash.com/photo-1523293182086-7651a899d37f?auto=format&fit=crop&w=600&q=80" alt="Instagram 3" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-white text-xl">
                <i class="fa-brands fa-instagram"></i>
            </div>
        </div>
        <div class="aspect-square bg-neutral-100 overflow-hidden relative group">
            <img src="https://images.unsplash.com/photo-1588405748880-12d1d2a59f75?auto=format&fit=crop&w=600&q=80" alt="Instagram 4" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-white text-xl">
                <i class="fa-brands fa-instagram"></i>
            </div>
        </div>
        <div class="aspect-square bg-neutral-100 overflow-hidden relative group col-span-2 sm:col-span-1">
            <img src="https://images.unsplash.com/photo-1594035910387-fea47794261f?auto=format&fit=crop&w=600&q=80" alt="Instagram 5" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-white text-xl">
                <i class="fa-brands fa-instagram"></i>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOV\.gemini\antigravity\scratch\zeen-parfum\resources\views/pages/home.blade.php ENDPATH**/ ?>