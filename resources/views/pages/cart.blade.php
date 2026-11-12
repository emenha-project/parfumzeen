@extends('layouts.app')

@section('title', 'Tas Belanja | ZEEN PARFUM Haute Parfumerie')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">
    <!-- Header -->
    <div class="border-b border-black pb-4 mb-8">
        <h1 class="font-serif-luxury text-3xl md:text-4xl font-bold tracking-tight text-black">
            TAS BELANJA SAYA
        </h1>
        <p class="text-xs text-neutral-500 font-light mt-1">
            Produk dalam tas belanja Anda belum dipesan hingga proses pembayaran selesai.
        </p>
    </div>

    @if(!empty($cart) && count($cart) > 0)
        <!-- Free Ongkir Progress Banner -->
        @php
            $remainingForFreeShipping = max(0, $freeShippingThreshold - $subtotal);
            $progressPercent = min(100, ($subtotal / $freeShippingThreshold) * 100);
        @endphp
        <div class="bg-neutral-900 text-white p-4 mb-8">
            <div class="flex items-center justify-between text-xs font-semibold uppercase tracking-wider mb-2">
                @if($remainingForFreeShipping > 0)
                    <span>✨ Belanja Rp {{ number_format($remainingForFreeShipping, 0, ',', '.') }} lagi untuk mendapatkan <strong>FREE ONGKIR</strong></span>
                @else
                    <span class="text-emerald-400">🎉 SELAMAT! ANDA MENDAPATKAN FREE ONGKIR SE-INDONESIA</span>
                @endif
                <i class="fa-solid fa-truck-fast"></i>
            </div>
            <div class="w-full bg-neutral-800 h-1.5 overflow-hidden">
                <div class="bg-white h-full transition-all duration-500" style="width: {{ $progressPercent }}%"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <!-- Left: Items List (8 Cols) -->
            <div class="lg:col-span-8 space-y-4">
                <div class="border border-neutral-200 divide-y divide-neutral-200">
                    @foreach($cart as $id => $item)
                        <div class="p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 bg-white">
                            <!-- Image & Details -->
                            <div class="flex items-center space-x-4">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                                     class="w-20 h-24 object-cover bg-neutral-50 border border-neutral-200 flex-shrink-0">
                                <div class="space-y-1">
                                    <span class="text-[10px] uppercase tracking-wider font-semibold text-neutral-500">
                                        {{ $item['concentration'] }}
                                    </span>
                                    <a href="{{ route('products.show', $item['slug'] ?? 'noir-absolu') }}" class="font-serif-luxury font-bold text-base block text-black hover:opacity-75">
                                        {{ $item['name'] }}
                                    </a>
                                    <div class="text-xs text-neutral-600 font-medium">Ukuran: <span class="font-bold text-black">{{ $item['size'] }}</span></div>
                                    <div class="text-xs font-bold text-black pt-1">
                                        Rp {{ number_format($item['price'], 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>

                            <!-- Qty & Subtotal -->
                            <div class="flex items-center space-x-6 w-full sm:w-auto justify-between sm:justify-end">
                                <!-- Quantity Form -->
                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center border border-neutral-300 h-10 bg-white">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <button type="button" onclick="updateItemQty(this, -1)" class="w-7 h-full flex items-center justify-center text-neutral-500 hover:text-black">
                                        <i class="fa-solid fa-minus text-[10px]"></i>
                                    </button>
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                           onchange="this.form.submit()"
                                           class="w-10 text-center text-xs font-bold border-none focus:outline-none bg-transparent">
                                    <button type="button" onclick="updateItemQty(this, 1)" class="w-7 h-full flex items-center justify-center text-neutral-500 hover:text-black">
                                        <i class="fa-solid fa-plus text-[10px]"></i>
                                    </button>
                                </form>

                                <!-- Total for Item -->
                                <div class="text-right">
                                    <div class="font-bold text-sm text-black">
                                        Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                    </div>
                                    <form action="{{ route('cart.remove') }}" method="POST" class="mt-1">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <button type="submit" class="text-[11px] text-red-500 hover:text-red-700 underline font-medium">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-between items-center pt-4">
                    <a href="{{ route('products.index') }}" class="text-xs font-bold uppercase tracking-wider text-black flex items-center space-x-2 hover:opacity-75">
                        <i class="fa-solid fa-arrow-left text-[10px]"></i>
                        <span>LANJUTKAN BELANJA</span>
                    </a>
                </div>
            </div>

            <!-- Right: Order Summary (4 Cols) -->
            <div class="lg:col-span-4 bg-neutral-50 border border-neutral-200 p-6 space-y-6">
                <h3 class="font-serif-luxury text-lg font-bold text-black border-b border-neutral-200 pb-3">
                    RINGKASAN PESANAN
                </h3>

                <div class="space-y-3 text-xs text-neutral-600">
                    <div class="flex justify-between">
                        <span>Subtotal Produk</span>
                        <span class="font-bold text-black">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <div>
                            <span>Ongkos Kirim Express</span>
                            <div class="text-[10px] text-neutral-400">Seluruh Indonesia</div>
                        </div>
                        <span class="font-bold text-black">
                            @if($shippingFee == 0)
                                <span class="text-emerald-700 uppercase font-bold">GRATIS</span>
                            @else
                                Rp {{ number_format($shippingFee, 0, ',', '.') }}
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between text-neutral-500 text-[11px]">
                        <span>Gratis 2 Sample Discovery Vial</span>
                        <span class="text-emerald-700 font-bold uppercase">TERMASUK</span>
                    </div>
                </div>

                <!-- Promo Voucher Input -->
                <div class="pt-2 border-t border-neutral-200">
                    <form onsubmit="event.preventDefault(); alert('Voucher PRIVILEGE100 berhasil diterapkan! (Demo)');" class="flex gap-2">
                        <input type="text" placeholder="Kode Promo / Voucher"
                               class="flex-1 bg-white border border-neutral-300 text-xs px-3 py-2 uppercase tracking-wider focus:outline-none focus:border-black">
                        <button type="submit" class="bg-black text-white text-xs font-bold uppercase px-4 py-2 hover:bg-neutral-800">
                            PAKAI
                        </button>
                    </form>
                </div>

                <!-- Grand Total -->
                <div class="border-t border-neutral-200 pt-4 flex justify-between items-baseline">
                    <div>
                        <span class="font-bold text-sm text-black">TOTAL PEMBAYARAN</span>
                        <div class="text-[10px] text-neutral-400">Sudah termasuk PPN</div>
                    </div>
                    <span class="font-sans font-bold text-xl text-black">
                        Rp {{ number_format($grandTotal, 0, ',', '.') }}
                    </span>
                </div>

                <!-- Checkout CTA -->
                <div class="pt-2 space-y-3">
                    <a href="{{ route('checkout.index') }}"
                       class="w-full bg-black hover:bg-neutral-800 text-white text-xs font-bold uppercase tracking-widest py-4 flex items-center justify-center space-x-2 transition">
                        <span>LANJUT KE PEMBAYARAN</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>

                    <div class="text-[11px] text-neutral-500 text-center space-y-1">
                        <div class="flex items-center justify-center space-x-1 text-emerald-700 font-medium">
                            <i class="fa-solid fa-lock text-[10px]"></i>
                            <span>Checkout Aman dengan Enkripsi 256-bit</span>
                        </div>
                        <p>Mendukung QRIS, BCA, Mandiri, BNI, BRI</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart State -->
        <div class="text-center py-24 bg-neutral-50 border border-neutral-200 max-w-xl mx-auto p-12">
            <i class="fa-solid fa-bag-shopping text-5xl text-neutral-300 mb-4"></i>
            <h3 class="font-serif-luxury text-2xl font-bold mb-2">Tas Belanja Anda Kosong</h3>
            <p class="text-xs text-neutral-500 max-w-sm mx-auto mb-6">
                Temukan aroma tanda tangan Anda dari koleksi Extrait de Parfum dan Discovery Set kami.
            </p>
            <a href="{{ route('products.index') }}"
               class="inline-block bg-black text-white text-xs font-bold uppercase tracking-widest px-8 py-3.5 hover:bg-neutral-800 transition">
                JELAJAHI KOLEKSI PARFUM
            </a>
        </div>
    @endif
</div>

@push('scripts')
<script>
    function updateItemQty(button, delta) {
        const input = button.parentElement.querySelector('input[name="quantity"]');
        let val = parseInt(input.value) || 1;
        val += delta;
        if (val < 1) val = 1;
        input.value = val;
        button.form.submit();
    }
</script>
@endpush
@endsection

