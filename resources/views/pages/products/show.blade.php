@extends('layouts.app')

@section('title', $product->name . ' - ' . $product->concentration . ' | ZEEN PARFUM')
@section('meta_description', $product->name . ': ' . $product->subtitle . '. Diformulasikan dengan konsentrasi murni.')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    <!-- Breadcrumb -->
    <nav class="text-[11px] text-neutral-400 uppercase tracking-wider mb-8 flex items-center space-x-2">
        <a href="{{ route('home') }}" class="hover:text-black">Beranda</a>
        <span>/</span>
        <a href="{{ route('products.index') }}" class="hover:text-black">Koleksi</a>
        <span>/</span>
        <span class="text-black font-semibold">{{ $product->name }}</span>
    </nav>

    <!-- Main Product Section (2 Columns Sephora Layout) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        <!-- Left: Image Gallery (5 Cols) -->
        <div class="lg:col-span-6 space-y-4 lg:sticky lg:top-28">
            <div class="aspect-[4/5] bg-neutral-50 overflow-hidden relative border border-neutral-200">
                @if($product->badge)
                    <div class="absolute top-4 left-4 z-10 bg-black text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1.5">
                        {{ $product->badge }}
                    </div>
                @endif
                <img id="main-product-image"
                     src="{{ $product->image }}"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover transition-all duration-300">
            </div>

            <!-- Thumbnail Carousel if gallery available -->
            @if(!empty($product->gallery) && count($product->gallery) > 1)
                <div class="grid grid-cols-4 gap-3">
                    @foreach($product->gallery as $idx => $thumb)
                        <button onclick="document.getElementById('main-product-image').src = '{{ $thumb }}'"
                                class="aspect-square border border-neutral-200 hover:border-black overflow-hidden bg-neutral-50 focus:outline-none focus:border-black">
                            <img src="{{ $thumb }}" alt="Thumbnail {{ $idx }}" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            @endif

            <!-- Assurance icons beneath gallery -->
            <div class="grid grid-cols-3 gap-3 pt-4 text-center text-[11px] text-neutral-600 border-t border-neutral-100">
                <div class="flex flex-col items-center p-2 bg-neutral-50 rounded">
                    <i class="fa-solid fa-certificate text-base text-black mb-1"></i>
                    <span class="font-bold text-black uppercase tracking-wider text-[9px]">100% ORIGINAL</span>
                    <span class="text-[10px] text-neutral-400">Terdaftar BPOM</span>
                </div>
                <div class="flex flex-col items-center p-2 bg-neutral-50 rounded">
                    <i class="fa-solid fa-truck-fast text-base text-black mb-1"></i>
                    <span class="font-bold text-black uppercase tracking-wider text-[9px]">FREE ONGKIR</span>
                    <span class="text-[10px] text-neutral-400">Min. Rp 500k</span>
                </div>
                <div class="flex flex-col items-center p-2 bg-neutral-50 rounded">
                    <i class="fa-solid fa-vials text-base text-black mb-1"></i>
                    <span class="font-bold text-black uppercase tracking-wider text-[9px]">2 FREE SAMPLES</span>
                    <span class="text-[10px] text-neutral-400">Di setiap paket</span>
                </div>
            </div>
        </div>

        <!-- Right: Purchasing & Olfactory Info (6 Cols) -->
        <div class="lg:col-span-6 space-y-6">
            <!-- Header Info -->
            <div class="border-b border-neutral-200 pb-6 space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-xs uppercase tracking-[0.25em] text-neutral-500 font-bold">
                        ZEEN PRIVATE RESERVE • {{ $product->fragrance_family }}
                    </span>
                    <!-- Wishlist button -->
                    <button onclick="this.classList.toggle('text-red-500')" class="text-neutral-400 hover:text-red-500 transition p-1">
                        <i class="fa-solid fa-heart text-lg"></i>
                    </button>
                </div>

                <h1 class="font-serif-luxury text-3xl md:text-5xl font-bold text-black tracking-tight leading-tight">
                    {{ $product->name }}
                </h1>
                <p class="text-xs md:text-sm text-neutral-500 font-light">{{ $product->subtitle }}</p>

                <!-- Rating -->
                <div class="flex items-center space-x-2 pt-1 text-xs">
                    <div class="text-luxury-gold flex text-xs">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <span class="font-bold text-black">{{ number_format($product->rating, 2) }}</span>
                    <span class="text-neutral-400">|</span>
                    <a href="#reviews" class="text-neutral-600 underline font-medium">{{ $product->reviews_count }} Ulasan Terverifikasi</a>
                </div>

                <!-- Price display -->
                <div class="pt-4 flex items-baseline space-x-3">
                    <span id="product-price-display" class="font-sans font-bold text-2xl md:text-3xl text-black">
                        {{ $product->formatted_price }}
                    </span>
                    @if($product->original_price)
                        <span id="product-original-price" class="text-sm text-neutral-400 line-through">
                            {{ $product->formatted_original_price }}
                        </span>
                        <span class="bg-red-100 text-red-800 text-[10px] font-bold px-2 py-0.5 rounded">
                            HEMAT {{ $product->discount_percentage }}%
                        </span>
                    @endif
                </div>
            </div>

            <!-- Size Selector -->
            <div class="space-y-3">
                <div class="flex justify-between items-center text-xs">
                    <span class="font-bold uppercase tracking-wider text-black">PILIH UKURAN BOTOL</span>
                    <span class="text-neutral-500 font-light">Konsentrasi: {{ $product->concentration }}</span>
                </div>
                <div class="flex flex-wrap gap-3" id="size-options">
                    @php
                        $sizes = $product->available_sizes ?? ['50ml', '100ml'];
                    @endphp
                    @foreach($sizes as $index => $sz)
                        <button type="button"
                                onclick="selectSize('{{ $sz }}', {{ $product->price }}, this)"
                                class="size-btn px-5 py-3 border text-xs font-bold uppercase tracking-wider transition {{ $loop->first ? 'border-black bg-black text-white' : 'border-neutral-300 text-black hover:border-black' }}"
                                data-size="{{ $sz }}">
                            {{ $sz }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Form: Add to Bag & Buy Now -->
            <form action="{{ route('cart.add') }}" method="POST" id="add-to-cart-form" class="space-y-4 pt-2">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="size" id="selected-size-input" value="{{ $sizes[0] ?? '50ml' }}">

                <div class="flex items-center space-x-3">
                    <!-- Qty Selector -->
                    <div class="flex items-center border border-neutral-300 h-12 w-28 bg-white">
                        <button type="button" onclick="adjustQty(-1)" class="w-8 h-full flex items-center justify-center text-neutral-600 hover:text-black focus:outline-none">
                            <i class="fa-solid fa-minus text-xs"></i>
                        </button>
                        <input type="number" name="quantity" id="product-qty-input" value="1" min="1" max="{{ $product->stock }}"
                               class="w-12 text-center text-xs font-bold focus:outline-none border-none bg-transparent">
                        <button type="button" onclick="adjustQty(1)" class="w-8 h-full flex items-center justify-center text-neutral-600 hover:text-black focus:outline-none">
                            <i class="fa-solid fa-plus text-xs"></i>
                        </button>
                    </div>

                    <!-- Add to Bag CTA -->
                    <button type="submit"
                            class="flex-1 bg-black text-white h-12 text-xs font-bold uppercase tracking-widest flex items-center justify-center space-x-2 hover:bg-neutral-800 transition">
                        <i class="fa-solid fa-bag-shopping text-sm"></i>
                        <span>TAMBAH KE TAS BELANJA</span>
                    </button>
                </div>
            </form>

            <!-- 3 OLFACTORY PYRAMID VISUAL CARDS -->
            <div class="pt-6 border-t border-neutral-200 space-y-3">
                <h3 class="font-serif-luxury text-base font-bold text-black tracking-wide">
                    PIRAMIDA AROMA (NOTES BREAKDOWN)
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div class="border border-neutral-200 p-3.5 bg-neutral-50/50">
                        <span class="text-[9px] uppercase tracking-widest font-bold text-neutral-400 block mb-1">01. TOP NOTES</span>
                        <div class="font-serif-luxury font-bold text-xs text-black">{{ $product->top_notes ?? 'Bergamot, Pink Pepper' }}</div>
                        <p class="text-[10px] text-neutral-500 mt-1">Kesan segar awal saat disemprotkan (0-30 min)</p>
                    </div>
                    <div class="border border-neutral-200 p-3.5 bg-neutral-50/50">
                        <span class="text-[9px] uppercase tracking-widest font-bold text-neutral-400 block mb-1">02. HEART NOTES</span>
                        <div class="font-serif-luxury font-bold text-xs text-black">{{ $product->heart_notes ?? 'Rare Oud, Orris Butter' }}</div>
                        <p class="text-[10px] text-neutral-500 mt-1">Karakter utama & pesona inti wangi (30m-4h)</p>
                    </div>
                    <div class="border border-neutral-200 p-3.5 bg-neutral-50/50">
                        <span class="text-[9px] uppercase tracking-widest font-bold text-neutral-400 block mb-1">03. BASE NOTES</span>
                        <div class="font-serif-luxury font-bold text-xs text-black">{{ $product->base_notes ?? 'Madagascar Vanilla, Amber' }}</div>
                        <p class="text-[10px] text-neutral-500 mt-1">Jejak aroma mewah tahan lama (4-16+ jam)</p>
                    </div>
                </div>
            </div>

            <!-- Performance Meters (Longevity & Sillage) -->
            <div class="grid grid-cols-2 gap-4 p-4 bg-neutral-50 border border-neutral-200 text-xs">
                <div>
                    <span class="text-[10px] uppercase tracking-wider text-neutral-400 font-bold block mb-1">KETAHANAN AROMA</span>
                    <span class="font-bold text-black flex items-center space-x-1">
                        <i class="fa-solid fa-clock text-xs text-neutral-700 mr-1"></i>
                        {{ $product->longevity }}
                    </span>
                </div>
                <div>
                    <span class="text-[10px] uppercase tracking-wider text-neutral-400 font-bold block mb-1">JEJAK WANGI (SILLAGE)</span>
                    <span class="font-bold text-black flex items-center space-x-1">
                        <i class="fa-solid fa-wind text-xs text-neutral-700 mr-1"></i>
                        {{ $product->sillage }}
                    </span>
                </div>
            </div>

            <!-- Accordion Details (Sephora Style Collapsible Tabs) -->
            <div class="border-t border-neutral-200 divide-y divide-neutral-200 text-xs">
                <!-- Tab 1: Description -->
                <div class="py-4">
                    <button onclick="toggleAccordion('desc')" class="w-full flex items-center justify-between font-bold uppercase tracking-wider text-black text-left">
                        <span>FILOSOFI & DESKRIPSI AROMA</span>
                        <i id="icon-desc" class="fa-solid fa-plus text-xs"></i>
                    </button>
                    <div id="content-desc" class="hidden pt-3 text-neutral-600 font-light leading-relaxed">
                        {{ $product->description }}
                    </div>
                </div>

                <!-- Tab 2: Application Advice -->
                <div class="py-4">
                    <button onclick="toggleAccordion('usage')" class="w-full flex items-center justify-between font-bold uppercase tracking-wider text-black text-left">
                        <span>PETUNJUK APLIKASI TERBAIK (HOW TO WEAR)</span>
                        <i id="icon-usage" class="fa-solid fa-plus text-xs"></i>
                    </button>
                    <div id="content-usage" class="hidden pt-3 text-neutral-600 font-light leading-relaxed space-y-2">
                        <p>1. Semprotkan pada titik nadi (pulse points): pergelangan tangan, leher, belakang telinga, dan bagian dalam siku.</p>
                        <p>2. Jangan menggosok kedua pergelangan tangan agar molekul top notes tidak rusak dan struktur piramida wangi tetap utuh.</p>
                        <p>3. Untuk sillage maksimal, aplikasikan setelah mandi pada kulit yang telah diberi pelembab (unscented lotion).</p>
                    </div>
                </div>

                <!-- Tab 3: BPOM & Authenticity -->
                <div class="py-4">
                    <button onclick="toggleAccordion('cert')" class="w-full flex items-center justify-between font-bold uppercase tracking-wider text-black text-left">
                        <span>SERTIFIKASI BPOM & KEASLIAN</span>
                        <i id="icon-cert" class="fa-solid fa-plus text-xs"></i>
                    </button>
                    <div id="content-cert" class="hidden pt-3 text-neutral-600 font-light leading-relaxed">
                        <p>Produk ZEEN PARFUM 100% diproduksi sesuai standar keselamatan kosmetik BPOM RI dan asosiasi wewangian internasional IFRA (International Fragrance Association). Bebas bahan kimia berbahaya, paraben, dan tidak diujicobakan pada hewan (Cruelty-Free).</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- REVIEWS SECTION -->
    <section id="reviews" class="mt-20 pt-12 border-t border-black">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8">
            <div>
                <span class="text-[10px] uppercase tracking-[0.25em] text-neutral-500 font-semibold">AVIS CLIENTS</span>
                <h3 class="font-serif-luxury text-2xl md:text-3xl font-bold">ULASAN PELANGGAN TERVERIFIKASI</h3>
            </div>
            <div class="mt-4 md:mt-0 flex items-center space-x-3 text-xs">
                <span class="text-neutral-500">Skor Kepuasan:</span>
                <span class="font-bold text-lg text-black">{{ number_format($product->rating, 2) }} / 5.0</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($product->reviews as $rev)
                <div class="border border-neutral-200 p-6 bg-neutral-50/50 space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="text-luxury-gold flex text-xs">
                            @for($i = 0; $i < $rev->rating; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                        </div>
                        <span class="text-[11px] text-neutral-400">{{ $rev->created_at ? $rev->created_at->diffForHumans() : 'Baru saja' }}</span>
                    </div>
                    <p class="text-xs text-neutral-700 leading-relaxed font-light italic">"{{ $rev->comment }}"</p>
                    <div class="flex items-center space-x-2 text-[11px] pt-2 border-t border-neutral-200">
                        <span class="font-bold text-black">{{ $rev->customer_name }}</span>
                        @if($rev->customer_city)
                            <span class="text-neutral-400">• {{ $rev->customer_city }}</span>
                        @endif
                        <span class="text-emerald-700 font-medium ml-auto flex items-center">
                            <i class="fa-solid fa-circle-check text-[10px] mr-1"></i> Pembeli Terverifikasi
                        </span>
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-center py-10 text-neutral-400 text-xs">
                    Jadilah orang pertama yang memberikan ulasan untuk aroma eksklusif ini.
                </div>
            @endforelse
        </div>
    </section>

    <!-- RELATED PRODUCTS -->
    @if($relatedProducts->count() > 0)
        <section class="mt-20 pt-12 border-t border-neutral-200">
            <div class="flex items-center justify-between mb-8">
                <h3 class="font-serif-luxury text-2xl font-bold text-black">AROMA SERUPA YANG MUNGKIN ANDA SUKAI</h3>
                <a href="{{ route('products.index') }}" class="text-xs font-bold uppercase tracking-wider text-black hover:opacity-75">
                    LIHAT SEMUA
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($relatedProducts as $rel)
                    <div class="group border border-neutral-100 hover:border-black p-3 transition bg-white flex flex-col justify-between">
                        <a href="{{ route('products.show', $rel->slug) }}" class="aspect-[4/5] overflow-hidden bg-neutral-50 mb-3 block">
                            <img src="{{ $rel->image }}" alt="{{ $rel->name }}" class="w-full h-full object-cover group-hover:scale-105 transition">
                        </a>
                        <div class="space-y-1">
                            <span class="text-[9px] uppercase tracking-wider text-neutral-500 font-semibold">{{ $rel->concentration }}</span>
                            <a href="{{ route('products.show', $rel->slug) }}" class="font-serif-luxury font-bold text-sm block truncate text-black">
                                {{ $rel->name }}
                            </a>
                            <div class="font-bold text-xs text-black">{{ $rel->formatted_price }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
</div>

@push('scripts')
<script>
    function adjustQty(amount) {
        const input = document.getElementById('product-qty-input');
        let current = parseInt(input.value) || 1;
        current += amount;
        if (current < 1) current = 1;
        input.value = current;
    }

    function selectSize(size, basePrice, btn) {
        document.querySelectorAll('.size-btn').forEach(b => {
            b.classList.remove('border-black', 'bg-black', 'text-white');
            b.classList.add('border-neutral-300', 'text-black');
        });
        btn.classList.add('border-black', 'bg-black', 'text-white');
        btn.classList.remove('border-neutral-300', 'text-black');

        document.getElementById('selected-size-input').value = size;

        // Dynamic price calculation
        let calculatedPrice = basePrice;
        if (size === '100ml') {
            calculatedPrice = basePrice * 1.6;
        }
        document.getElementById('product-price-display').textContent = 'Rp ' + Number(calculatedPrice).toLocaleString('id-ID');
    }

    function toggleAccordion(id) {
        const content = document.getElementById('content-' + id);
        const icon = document.getElementById('icon-' + id);
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.classList.remove('fa-plus');
            icon.classList.add('fa-minus');
        } else {
            content.classList.add('hidden');
            icon.classList.remove('fa-minus');
            icon.classList.add('fa-plus');
        }
    }
</script>
@endpush
@endsection
