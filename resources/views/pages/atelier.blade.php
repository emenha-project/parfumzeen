@extends('layouts.app')

@section('title', 'Tentang L\'Atelier | ZEEN PARFUM Haute Parfumerie')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <!-- Hero Editorial Banner -->
    <div class="relative bg-black text-white aspect-[21/9] min-h-[350px] overflow-hidden flex items-center justify-center p-8 mb-16">
        <img src="https://images.unsplash.com/photo-1547887537-6158d64c35b3?auto=format&fit=crop&w=1600&q=85"
             alt="Atelier ZEEN"
             class="absolute inset-0 w-full h-full object-cover opacity-40">
        <div class="relative z-10 text-center max-w-xl space-y-3">
            <span class="text-luxury-champagne text-[10px] font-bold uppercase tracking-[0.3em]">MANIFIESTO HAUTE PARFUMERIE</span>
            <h1 class="font-serif-luxury text-3xl md:text-5xl font-bold tracking-tight">SENI WEWANGIAN MURNI</h1>
            <p class="text-xs text-neutral-300 font-light leading-relaxed">
                Dipersembahkan untuk mereka yang tidak sekadar memakai wangi, melainkan meninggalkan impresi abadi.
            </p>
        </div>
    </div>

    <!-- Editorial 2 Columns (Image heavy, minimal text) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-20">
        <div class="aspect-[4/5] bg-neutral-100 overflow-hidden shadow-lg">
            <img src="https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?auto=format&fit=crop&w=1000&q=85"
                 alt="Perfume formulation"
                 class="w-full h-full object-cover">
        </div>
        <div class="space-y-6">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-neutral-400">01 • FILOSOFI PERACIKAN</span>
            <h2 class="font-serif-luxury text-3xl md:text-4xl font-bold text-black leading-tight">
                KONSENTRASI EXTRAIT DE PARFUM 35%
            </h2>
            <p class="text-xs text-neutral-600 font-light leading-relaxed">
                Setiap botol ZEEN PARFUM diracik dengan minyak konsentrat esensial murni sebesar 35%—standar tertinggi di industri wewangian mewah dunia (Extrait de Parfum), jauh melampaui rata-rata Eau de Parfum konvensional (15-20%).
            </p>
            <p class="text-xs text-neutral-600 font-light leading-relaxed">
                Hasilnya adalah proyeksi aroma yang matang, keanggunan sillage yang tidak menyengat di hidung, serta daya tahan menakjubkan hingga 16 jam pada kulit dan 48 jam pada serat kain.
            </p>
            <div class="pt-2">
                <a href="{{ route('products.index', ['category' => 'extrait-de-parfum']) }}"
                   class="inline-block bg-black text-white text-xs font-bold uppercase tracking-widest px-8 py-3.5 hover:bg-neutral-800 transition">
                    JELAJAHI EXTRAIT DE PARFUM
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-20">
        <div class="order-2 md:order-1 space-y-6">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-neutral-400">02 • BAHAN BAKU LANGKA</span>
            <h2 class="font-serif-luxury text-3xl md:text-4xl font-bold text-black leading-tight">
                HARMONI ALAM GRASSE & NUSANTARA
            </h2>
            <p class="text-xs text-neutral-600 font-light leading-relaxed">
                Kami menjembatani kearifan perkebunan bunga legendaris Grasse, Prancis, dengan kemewahan rempah eksotis Indonesia: Kayu Cendana Kupang, Nilam Aceh kualitas prima, dan Oud Kalimantan yang disuling secara lestari.
            </p>
            <p class="text-xs text-neutral-600 font-light leading-relaxed">
                Tanpa pengawet agresif, 100% tersertifikasi BPOM RI dan asosiasi IFRA dunia.
            </p>
        </div>
        <div class="order-1 md:order-2 aspect-[4/5] bg-neutral-100 overflow-hidden shadow-lg">
            <img src="https://images.unsplash.com/photo-1523293182086-7651a899d37f?auto=format&fit=crop&w=1000&q=85"
                 alt="Fragrance Ingredients"
                 class="w-full h-full object-cover">
        </div>
    </div>
</div>
@endsection
