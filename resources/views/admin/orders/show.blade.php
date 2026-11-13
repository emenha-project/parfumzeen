@extends('admin.layout')

@section('title', 'Detail Pesanan: ' . $order->order_number)
@section('page_title', 'Pesanan ' . $order->order_number)
@section('page_subtitle', 'Rincian transaksi pelanggan, item parfum, dan verifikasi status pembayaran')

@section('actions')
    <a href="{{ route('admin.orders.index') }}" class="text-xs text-zinc-400 hover:text-zinc-200">
        &larr; Kembali ke Daftar Pesanan
    </a>
@endsection

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Top Status Action Card -->
    <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="text-xs text-zinc-400 mb-1">Status Pembayaran Saat Ini:</div>
            <div class="flex items-center gap-2">
                @if ($order->payment_status === 'paid')
                    <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/40">
                        LUNAS (PAID)
                    </span>
                    <span class="text-xs text-zinc-500">
                        Diverifikasi: {{ $order->paid_at ? $order->paid_at->format('d M Y, H:i') : '-' }}
                    </span>
                @elseif ($order->payment_status === 'reviewing')
                    <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-blue-500/20 text-blue-300 border border-blue-500/40">
                        MENUNGGU VERIFIKASI BUKTI
                    </span>
                @elseif ($order->payment_status === 'cancelled')
                    <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-zinc-800 text-zinc-400 border border-zinc-700">
                        DIBATALKAN (CANCELLED)
                    </span>
                @else
                    <span class="inline-flex px-3 py-1 rounded-md text-xs font-bold bg-amber-500/20 text-amber-300 border border-amber-500/40">
                        MENUNGGU PEMBAYARAN (PENDING)
                    </span>
                @endif
            </div>
        </div>

        <!-- Status Change Form -->
        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="flex items-center gap-2">
            @csrf
            @method('PATCH')
            <label class="text-xs text-zinc-400 font-medium">Ubah Status:</label>
            <select name="payment_status" class="bg-onyx-900 border border-zinc-700 rounded-lg px-3 py-1.5 text-xs text-zinc-100 focus:outline-none focus:border-gold-400">
                <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="reviewing" {{ $order->payment_status == 'reviewing' ? 'selected' : '' }}>Reviewing (Cek Bukti)</option>
                <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Tandai LUNAS (Paid)</option>
                <option value="cancelled" {{ $order->payment_status == 'cancelled' ? 'selected' : '' }}>Batalkan Pesanan</option>
            </select>
            <button type="submit" class="px-3.5 py-1.5 bg-gold-400 hover:bg-gold-300 text-onyx-900 font-semibold text-xs rounded-lg transition-colors">
                Perbarui
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Left Column: Items Breakdown -->
        <div class="md:col-span-2 space-y-6">
            <!-- Items Purchased Table -->
            <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl overflow-hidden shadow-xl">
                <div class="p-4 border-b border-zinc-800/80 flex items-center justify-between">
                    <h3 class="text-sm font-semibold text-zinc-100">Item Parfum Dipesan</h3>
                    <span class="text-xs text-zinc-500">{{ $order->items->count() }} Variasi</span>
                </div>

                <div class="divide-y divide-zinc-800/60 p-4 space-y-4">
                    @foreach ($order->items as $item)
                        <div class="flex items-center justify-between gap-4 pt-3 first:pt-0">
                            <div class="flex items-center gap-3">
                                <img src="{{ $item->product->image ?? 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?auto=format&fit=crop&w=150&q=80' }}"
                                     alt="{{ $item->product_name }}"
                                     class="w-12 h-14 object-cover rounded border border-zinc-800 bg-onyx-900 shrink-0">
                                <div>
                                    <div class="font-serif-lux font-semibold text-zinc-100 text-sm">{{ $item->product_name }}</div>
                                    <div class="text-xs text-zinc-400">Ukuran: {{ $item->size ?? '50ml' }}</div>
                                    <div class="text-[11px] text-gold-400 mt-0.5">
                                        Rp {{ number_format($item->price, 0, ',', '.') }} &times; {{ $item->quantity }} unit
                                    </div>
                                </div>
                            </div>

                            <div class="text-right font-serif-lux font-semibold text-zinc-100 text-sm">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Totals Section -->
                <div class="bg-onyx-900/80 p-4 border-t border-zinc-800/80 space-y-2 text-xs">
                    <div class="flex justify-between text-zinc-400">
                        <span>Subtotal Produk</span>
                        <span class="font-medium text-zinc-200">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-zinc-400">
                        <span>Biaya Pengiriman (Asuransi & Bubble Wrap)</span>
                        <span class="font-medium text-emerald-400">
                            {{ $order->shipping_fee > 0 ? 'Rp ' . number_format($order->shipping_fee, 0, ',', '.') : 'GRATIS' }}
                        </span>
                    </div>
                    @if ($order->discount_amount > 0)
                        <div class="flex justify-between text-zinc-400">
                            <span>Diskon Promo</span>
                            <span class="font-medium text-rose-400">- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between text-zinc-100 font-semibold text-sm pt-2 border-t border-zinc-800 font-serif-lux">
                        <span>Total Pembayaran</span>
                        <span class="text-gold-300 text-base">{{ $order->formatted_total }}</span>
                    </div>
                </div>
            </div>

            <!-- Bukti Pembayaran (Payment Proof) -->
            @if ($order->payment_proof)
                <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-5">
                    <h3 class="text-sm font-semibold text-zinc-100 mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>Bukti Transfer yang Diupload Pelanggan</span>
                    </h3>
                    <a href="{{ $order->payment_proof }}" target="_blank" class="block group relative overflow-hidden rounded-lg border border-zinc-700 max-w-sm">
                        <img src="{{ $order->payment_proof }}" alt="Bukti Transfer" class="w-full object-cover max-h-72 group-hover:scale-105 transition-transform">
                        <div class="absolute inset-0 bg-onyx-900/60 opacity-0 group-hover:opacity-100 flex items-center justify-center text-xs text-gold-300 font-medium transition-opacity">
                            Klik untuk memperbesar gambar &rarr;
                        </div>
                    </a>
                </div>
            @endif
        </div>

        <!-- Right Column: Customer & Shipping Details -->
        <div class="space-y-6">
            <!-- Customer Card -->
            <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-5 space-y-4">
                <h3 class="text-sm font-semibold text-zinc-100 pb-2 border-b border-zinc-800">
                    Informasi Pembeli
                </h3>

                <div class="text-xs space-y-2.5">
                    <div>
                        <div class="text-zinc-500 uppercase tracking-wider text-[10px]">Nama Lengkap</div>
                        <div class="text-zinc-100 font-medium text-sm">{{ $order->customer_name }}</div>
                    </div>

                    <div>
                        <div class="text-zinc-500 uppercase tracking-wider text-[10px]">Kontak WhatsApp / Telp</div>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}" target="_blank" class="text-gold-300 hover:underline flex items-center gap-1 font-mono">
                            {{ $order->customer_phone }}
                            <svg class="w-3 h-3 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </div>

                    <div>
                        <div class="text-zinc-500 uppercase tracking-wider text-[10px]">Alamat Email</div>
                        <div class="text-zinc-300 font-mono">{{ $order->customer_email }}</div>
                    </div>
                </div>
            </div>

            <!-- Shipping Address Card -->
            <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-5 space-y-3">
                <h3 class="text-sm font-semibold text-zinc-100 pb-2 border-b border-zinc-800">
                    Alamat Pengiriman
                </h3>

                <div class="text-xs space-y-2 text-zinc-300">
                    <p class="leading-relaxed">{{ $order->customer_address }}</p>
                    <div class="text-zinc-400">
                        {{ $order->customer_city }}, {{ $order->customer_province }} {{ $order->customer_postal_code }}
                    </div>

                    @if ($order->customer_notes)
                        <div class="mt-3 p-2.5 rounded bg-onyx-900 border border-zinc-800 text-[11px] text-zinc-400">
                            <span class="text-gold-400 font-medium">Catatan Pembeli:</span>
                            {{ $order->customer_notes }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Invoice Link -->
            <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-4">
                <a href="{{ route('order.invoice', $order->order_number) }}" target="_blank"
                   class="w-full flex items-center justify-center gap-2 py-2.5 bg-zinc-800 hover:bg-zinc-700 text-zinc-200 text-xs rounded-lg border border-zinc-700 transition-colors font-medium">
                    <svg class="w-4 h-4 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    <span>Cetak Faktur / Invoice Resmi</span>
                </a>
            </div>
        </div>

    </div>

</div>
@endsection

