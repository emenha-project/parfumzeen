@extends('layouts.app')

@section('title', 'Lacak Pesanan #' . $order->order_number . ' — ZEEN Atelier')

@section('content')
{{-- Hero --}}
<section class="bg-black text-white py-12 px-4">
    <div class="max-w-3xl mx-auto">
        <p class="text-xs tracking-[0.3em] text-amber-400 uppercase mb-2">ZEEN Atelier — Pelacakan Pesanan</p>
        <h1 class="text-2xl md:text-3xl font-light tracking-widest uppercase mb-1">{{ $order->order_number }}</h1>
        <p class="text-gray-400 text-sm">{{ $order->customer_name }} &bull; {{ $order->customer_city }}</p>
    </div>
</section>

<div class="max-w-3xl mx-auto px-4 py-10 space-y-8">

    {{-- Status Badge & Resi --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Status Pesanan</p>
                @php
                    $colors = [
                        'pending'    => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                        'confirmed'  => 'bg-blue-100 text-blue-800 border-blue-200',
                        'packed'     => 'bg-purple-100 text-purple-800 border-purple-200',
                        'shipped'    => 'bg-indigo-100 text-indigo-800 border-indigo-200',
                        'in_transit' => 'bg-orange-100 text-orange-800 border-orange-200',
                        'delivered'  => 'bg-green-100 text-green-800 border-green-200',
                        'cancelled'  => 'bg-red-100 text-red-800 border-red-200',
                    ];
                    $badgeClass = $colors[$order->order_status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                @endphp
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full border text-sm font-semibold {{ $badgeClass }}">
                    @php
                        $icons = ['pending'=>'🕐','confirmed'=>'✅','packed'=>'📦','shipped'=>'🚚','in_transit'=>'📍','delivered'=>'🎉','cancelled'=>'❌'];
                    @endphp
                    {{ $icons[$order->order_status] ?? '📋' }}
                    {{ $order->order_status_label }}
                </span>
            </div>

            @if($order->resi_number)
            <div class="bg-gray-50 rounded-xl p-4 text-center md:text-right">
                <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Nomor Resi</p>
                <p class="font-mono font-bold text-gray-900 text-lg">{{ $order->resi_number }}</p>
                @if($order->courier)
                <p class="text-xs text-gray-500 mt-1">via <span class="font-semibold text-gray-700">{{ $order->courier }}</span></p>
                @endif
            </div>
            @endif
        </div>

        @if($order->estimated_delivery)
        <div class="mt-4 pt-4 border-t border-gray-100 flex items-center gap-3">
            <span class="text-2xl">📅</span>
            <div>
                <p class="text-xs text-gray-500">Estimasi Tiba</p>
                <p class="font-semibold text-gray-900">{{ $order->estimated_delivery->format('d M Y') }}</p>
            </div>
        </div>
        @endif
    </div>

    {{-- Shopee-style Tracking Timeline --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
        <h2 class="text-sm font-semibold text-gray-900 uppercase tracking-widest mb-6">📋 Riwayat Pengiriman</h2>

        <div class="relative">
            @foreach($order->tracking_timeline as $index => $step)
            <div class="flex gap-4 {{ !$loop->last ? 'pb-8' : '' }} relative">
                {{-- Vertical Line --}}
                @if(!$loop->last)
                <div class="absolute left-5 top-10 bottom-0 w-0.5 {{ $step['done'] || $step['active'] ? 'bg-black' : 'bg-gray-200' }}"></div>
                @endif

                {{-- Icon Circle --}}
                <div class="relative z-10 flex-shrink-0">
                    <div class="w-10 h-10 rounded-full border-2 flex items-center justify-center text-base
                        {{ $step['active'] ? 'border-black bg-black text-white shadow-lg scale-110' : ($step['done'] ? 'border-black bg-black text-white' : 'border-gray-200 bg-gray-50 text-gray-400') }}
                        transition-all">
                        @if($step['active'])
                            <span class="animate-pulse">{{ $step['icon'] }}</span>
                        @else
                            {{ $step['done'] ? '✓' : $step['icon'] }}
                        @endif
                    </div>
                </div>

                {{-- Content --}}
                <div class="flex-1 pb-1">
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-1">
                        <div>
                            <p class="font-semibold text-sm {{ $step['active'] ? 'text-black' : ($step['done'] ? 'text-gray-800' : 'text-gray-400') }}">
                                {{ $step['label'] }}
                                @if($step['active'])
                                <span class="ml-2 text-xs bg-black text-white px-2 py-0.5 rounded-full">Sekarang</span>
                                @endif
                            </p>
                            <p class="text-xs {{ $step['active'] || $step['done'] ? 'text-gray-600' : 'text-gray-400' }} mt-0.5">
                                {{ $step['desc'] }}
                            </p>
                        </div>
                        @if($step['timestamp'])
                        <p class="text-xs text-gray-400 whitespace-nowrap md:text-right flex-shrink-0">
                            🕐 {{ $step['timestamp'] }}
                        </p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Order Details --}}
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
            <h2 class="text-sm font-semibold text-gray-900 uppercase tracking-widest">🛍 Detail Pesanan</h2>
        </div>
        <div class="p-6 space-y-3">
            @foreach($order->items as $item)
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                    @if($item->product)
                    <img src="{{ $item->product->image }}" alt="{{ $item->product_name }}"
                         class="w-full h-full object-cover" loading="lazy">
                    @else
                    <div class="w-full h-full flex items-center justify-center text-2xl">🧴</div>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ $item->product_name }}</p>
                    <p class="text-xs text-gray-500">{{ $item->product_size }} × {{ $item->quantity }}</p>
                </div>
                <p class="text-sm font-semibold text-gray-900 whitespace-nowrap">
                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                </p>
            </div>
            @endforeach

            <div class="border-t border-gray-100 pt-4 mt-4 space-y-2">
                <div class="flex justify-between text-sm text-gray-600">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm text-gray-600">
                    <span>Ongkir ({{ $order->courier ?? 'Ekspedisi' }})</span>
                    <span>Rp {{ number_format($order->shipping_fee, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-base font-bold text-gray-900 border-t border-gray-200 pt-3 mt-2">
                    <span>Total</span>
                    <span class="text-amber-600">{{ $order->formatted_total }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Shipping Address --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
        <h2 class="text-sm font-semibold text-gray-900 uppercase tracking-widest mb-4">📍 Alamat Pengiriman</h2>
        <div class="flex gap-3">
            <span class="text-2xl">🏠</span>
            <div>
                <p class="font-semibold text-gray-900">{{ $order->customer_name }}</p>
                <p class="text-sm text-gray-600">{{ $order->customer_phone }}</p>
                <p class="text-sm text-gray-600 mt-1">{{ $order->customer_address }}, {{ $order->customer_city }}
                    @if($order->customer_province), {{ $order->customer_province }}@endif
                    @if($order->customer_postal_code) {{ $order->customer_postal_code }}@endif
                </p>
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="flex flex-col sm:flex-row gap-3">
        <a href="{{ route('tracking.index') }}"
           class="flex-1 text-center border border-gray-300 text-gray-700 py-3 rounded-lg text-sm font-semibold hover:bg-gray-50 transition-colors">
            ← Lacak Pesanan Lain
        </a>
        <a href="{{ route('order.invoice', $order->order_number) }}"
           class="flex-1 text-center bg-black text-white py-3 rounded-lg text-sm font-semibold hover:bg-gray-800 transition-colors">
            🧾 Lihat Invoice
        </a>
        <a href="https://wa.me/6281234567890?text=Halo%20ZEEN%20Atelier%2C%20saya%20ingin%20tanya%20pesanan%20{{ $order->order_number }}"
           target="_blank"
           class="flex-1 text-center bg-green-600 text-white py-3 rounded-lg text-sm font-semibold hover:bg-green-700 transition-colors">
            💬 Hubungi CS
        </a>
    </div>

</div>
@endsection
