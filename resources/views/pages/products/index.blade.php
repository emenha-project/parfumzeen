@extends('layouts.app')

@section('title', 'Koleksi Lengkap | ZEEN PARFUM Haute Parfumerie')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">
    <!-- Breadcrumb -->
    <nav class="text-[11px] text-neutral-400 uppercase tracking-wider mb-6 flex items-center space-x-2">
        <a href="{{ route('home') }}" class="hover:text-black">Beranda</a>
        <span>/</span>
        <span class="text-black font-semibold">Koleksi Wewangian</span>
    </nav>

    <!-- Header & Filter Bar -->
    <div class="flex flex-col md:flex-row md:items-end justify-between pb-6 border-b border-black gap-4 mb-8">
        <div>
            <h1 class="font-serif-luxury text-3xl md:text-5xl font-bold tracking-tight text-black">
                SEMUA WEWANGIAN
            </h1>
            <p class="text-xs text-neutral-500 font-light mt-1">
                Menampilkan {{ $products->total() }} mahakarya aroma dengan konsentrasi murni.
            </p>
        </div>

        <!-- Filter & Sort Form -->
        <form method="GET" action="{{ route('products.index') }}" class="flex flex-wrap items-center gap-3">
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            @if(request('family'))
                <input type="hidden" name="family" value="{{ request('family') }}">
            @endif

            <!-- Sort dropdown -->
            <div class="relative">
                <select name="sort" onchange="this.form.submit()"
                        class="bg-white border border-neutral-300 text-xs font-semibold uppercase tracking-wider px-4 py-2.5 pr-8 appearance-none focus:outline-none focus:border-black cursor-pointer">
                    <option value="" {{ request('sort') == '' ? 'selected' : '' }}>URUTKAN: PALING LARIS</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>HARGA: RENDAH KE TINGGI</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>HARGA: TINGGI KE RENDAH</option>
                    <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>RATING TERTINGGI</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>TERBARU</option>
                </select>
                <i class="fa-solid fa-chevron-down absolute right-3 top-3.5 text-[10px] text-neutral-500 pointer-events-none"></i>
            </div>
        </form>
    </div>

    <!-- Category Filter Pills (Horizontal scrollable) -->
    <div class="flex items-center space-x-2 overflow-x-auto no-scrollbar pb-6 text-xs uppercase tracking-wider font-semibold">
        <a href="{{ route('products.index') }}"
           class="px-4 py-2 rounded-full border whitespace-nowrap transition {{ !request('category') && !request('family') ? 'bg-black text-white border-black' : 'bg-neutral-100 text-neutral-700 border-transparent hover:bg-neutral-200' }}">
            Semua ({{ $products->total() }})
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('products.index', ['category' => $cat->slug]) }}"
               class="px-4 py-2 rounded-full border whitespace-nowrap transition {{ request('category') == $cat->slug ? 'bg-black text-white border-black' : 'bg-neutral-100 text-neutral-700 border-transparent hover:bg-neutral-200' }}">
                {{ $cat->name }}
            </a>
        @endforeach
        @foreach($families as $fam)
            <a href="{{ route('products.index', ['family' => $fam]) }}"
               class="px-4 py-2 rounded-full border whitespace-nowrap transition {{ request('family') == $fam ? 'bg-black text-white border-black' : 'bg-neutral-50 text-neutral-600 border-neutral-200 hover:border-black' }}">
                #{{ $fam }}
            </a>
        @endforeach
    </div>

    <!-- Product Grid -->
    @if($products->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-8">
            @foreach($products as $item)
                <div class="group flex flex-col justify-between border border-neutral-100 hover:border-black p-3 md:p-4 transition-all duration-300 relative bg-white">
                    @if($item->badge)
                        <div class="absolute top-5 left-5 z-10 bg-black text-white text-[9px] font-bold uppercase tracking-widest px-2.5 py-1">
                            {{ $item->badge }}
                        </div>
                    @endif

                    <!-- Wishlist button -->
                    <button onclick="this.classList.toggle('text-red-500')" class="absolute top-5 right-5 z-10 text-neutral-300 hover:text-red-500 transition p-1">
                        <i class="fa-solid fa-heart text-sm"></i>
                    </button>

                    <!-- Image -->
                    <a href="{{ route('products.show', $item->slug) }}" class="block overflow-hidden aspect-[4/5] bg-neutral-50 mb-4 relative">
                        <img src="{{ $item->image }}" alt="{{ $item->name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </a>

                    <!-- Details -->
                    <div class="space-y-1.5 flex-1 flex flex-col">
                        <div class="text-[10px] uppercase tracking-wider text-neutral-500 font-semibold">
                            {{ $item->concentration }} • {{ $item->fragrance_family }}
                        </div>
                        <a href="{{ route('products.show', $item->slug) }}" class="block font-serif-luxury text-base font-bold text-black group-hover:opacity-70 transition leading-snug">
                            {{ $item->name }}
                        </a>
                        <p class="text-[11px] text-neutral-500 line-clamp-1 font-light">{{ $item->subtitle }}</p>

                        <!-- Rating Stars -->
                        <div class="flex items-center space-x-1 pt-1 text-[11px]">
                            <div class="text-luxury-gold flex text-[10px]">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <span class="text-neutral-500 text-[10px]">({{ $item->reviews_count }})</span>
                        </div>

                        <!-- Price -->
                        <div class="pt-2 flex items-baseline space-x-2 mt-auto">
                            <span class="font-bold text-sm md:text-base text-black font-sans">{{ $item->formatted_price }}</span>
                            @if($item->original_price)
                                <span class="text-xs text-neutral-400 line-through">{{ $item->formatted_original_price }}</span>
                            @endif
                        </div>
                    </div>

                    <!-- Quick Add To Bag Button -->
                    <div class="mt-4 pt-3 border-t border-neutral-100">
                        <button onclick="quickAddToCart({{ $item->id }})"
                                class="w-full bg-black hover:bg-neutral-800 text-white text-[11px] font-bold uppercase tracking-wider py-2.5 flex items-center justify-center space-x-2 transition">
                            <i class="fa-solid fa-bag-shopping text-xs"></i>
                            <span>TAMBAH KE TAS</span>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-12 flex justify-center">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-24 bg-neutral-50 border border-neutral-200">
            <i class="fa-solid fa-wind text-4xl text-neutral-300 mb-3"></i>
            <h3 class="font-serif-luxury text-xl font-bold">Tidak ada parfum yang cocok</h3>
            <p class="text-xs text-neutral-500 mt-1 max-w-sm mx-auto">Silakan coba kata kunci lain atau bersihkan filter kategori Anda.</p>
            <a href="{{ route('products.index') }}" class="inline-block mt-4 bg-black text-white text-xs uppercase tracking-widest font-bold px-6 py-2.5">
                Reset Filter
            </a>
        </div>
    @endif
</div>
@endsection
