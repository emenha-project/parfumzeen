@extends('admin.layout')

@section('title', 'Detail Pesanan: ' . $order->order_number)
@section('page_title', 'Pesanan ' . $order->order_number)
@section('page_subtitle', 'Rincian transaksi, tracking pengiriman seperti Shopee')

@section('actions')
    <a href="{{ route('admin.orders.index') }}" class="text-xs text-zinc-400 hover:text-zinc-200">
        &larr; Kembali ke Daftar Pesanan
    </a>
@endsection

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    @if(session('success'))
    <div class="bg-emerald-900/40 border border-emerald-500/40 text-emerald-300 rounded-xl px-5 py-3 text-sm flex items-center gap-3">
        <span>✅</span> {{ session('success') }}
    </div>
    @endif

    {{-- ===== TOP CARDS ROW ===== --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        @php
            $orderStatusColors = [
                'pending'    => 'text-amber-300 bg-amber-900/30 border-amber-700/40',
                'confirmed'  => 'text-blue-300 bg-blue-900/30 border-blue-700/40',
                'packed'     => 'text-purple-300 bg-purple-900/30 border-purple-700/40',
                'shipped'    => 'text-indigo-300 bg-indigo-900/30 border-indigo-700/40',
                'in_transit' => 'text-orange-300 bg-orange-900/30 border-orange-700/40',
                'delivered'  => 'text-emerald-300 bg-emerald-900/30 border-emerald-700/40',
                'cancelled'  => 'text-zinc-400 bg-zinc-800/40 border-zinc-700/40',
            ];
            $orderIcons = ['pending'=>'🕐','confirmed'=>'✅','packed'=>'📦','shipped'=>'🚚','in_transit'=>'📍','delivered'=>'🎉','cancelled'=>'❌'];
        @endphp
        <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-4 col-span-2">
            <div class="text-[10px] text-zinc-500 uppercase tracking-widest mb-1">Status Pengiriman</div>
            <div class="flex items-center gap-2 flex-wrap">
                <span class="px-3 py-1 rounded-full border text-xs font-bold {{ $orderStatusColors[$order->order_status] ?? 'text-zinc-400 bg-zinc-800 border-zinc-700' }}">
                    {{ $orderIcons[$order->order_status] ?? '📋' }} {{ $order->order_status_label }}
                </span>
                @if($order->payment_status === 'paid')
                <span class="px-2 py-1 rounded-full border text-xs bg-emerald-900/30 text-emerald-300 border-emerald-700/40">💳 Lunas</span>
                @endif
            </div>
        </div>
        <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-4">
            <div class="text-[10px] text-zinc-500 uppercase tracking-widest mb-1">Total</div>
            <div class="text-gold-400 font-bold text-sm">{{ $order->formatted_total }}</div>
        </div>
        <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-4">
            <div class="text-[10px] text-zinc-500 uppercase tracking-widest mb-1">Tanggal</div>
            <div class="text-zinc-200 text-xs font-medium">{{ $order->created_at->format('d M Y') }}</div>
            <div class="text-zinc-500 text-[10px]">{{ $order->created_at->format('H:i') }} WIB</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ===== LEFT: Items + Payment + Tracking ===== --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Items --}}
            <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl overflow-hidden">
                <div class="p-4 border-b border-zinc-800/80 flex items-center justify-between">
                    <h3 class="text-sm font-semibold text-zinc-100">🛍 Item Parfum Dipesan</h3>
                    <span class="text-xs text-zinc-500">{{ $order->items->count() }} item</span>
                </div>
                <div class="divide-y divide-zinc-800/60 p-4 space-y-3">
                    @foreach ($order->items as $item)
                    <div class="flex items-center justify-between gap-4 pt-3 first:pt-0">
                        <div class="flex items-center gap-3">
                            <img src="{{ $item->product->image ?? 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?auto=format&fit=crop&w=150&q=80' }}"
                                 alt="{{ $item->product_name }}"
                                 class="w-12 h-14 object-cover rounded border border-zinc-800 bg-onyx-900 shrink-0">
                            <div>
                                <div class="text-zinc-100 text-sm font-medium">{{ $item->product_name }}</div>
                                <div class="text-zinc-500 text-xs">{{ $item->product_size }} &times; {{ $item->quantity }}</div>
                                <div class="text-zinc-500 text-xs">@currency{{ number_format($item->unit_price, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        <div class="text-gold-300 font-bold text-sm whitespace-nowrap">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </div>
                    </div>
                    @endforeach

                    {{-- Totals --}}
                    <div class="pt-4 border-t border-zinc-800 space-y-1.5 text-xs">
                        <div class="flex justify-between text-zinc-400"><span>Subtotal</span><span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span></div>
                        <div class="flex justify-between text-zinc-400"><span>Ongkir {{ $order->courier ? '('.$order->courier.')' : '' }}</span><span>Rp {{ number_format($order->shipping_fee, 0, ',', '.') }}</span></div>
                        @if($order->discount_amount > 0)
                        <div class="flex justify-between text-emerald-400"><span>Diskon</span><span>-Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span></div>
                        @endif
                        <div class="flex justify-between text-zinc-100 font-bold text-sm border-t border-zinc-700 pt-2 mt-2">
                            <span>Total Bayar</span><span class="text-gold-400">{{ $order->formatted_total }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== TRACKING PANEL (Shopee-style) ===== --}}
            <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl overflow-hidden">
                <div class="p-4 border-b border-zinc-800/80">
                    <h3 class="text-sm font-semibold text-zinc-100">🚚 Update Status Pengiriman</h3>
                    <p class="text-xs text-zinc-500 mt-0.5">Update status seperti Shopee — otomatis tampil di halaman tracking pelanggan</p>
                </div>

                {{-- Resi & Courier Form --}}
                <div class="p-4 border-b border-zinc-800/60">
                    <form action="{{ route('admin.orders.updateOrderStatus', $order) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Status Dropdown --}}
                            <div>
                                <label class="block text-[10px] text-zinc-500 uppercase tracking-widest mb-1.5">Status Pengiriman *</label>
                                <select name="order_status" required
                                    class="w-full bg-onyx-900 border border-zinc-700 rounded-lg px-3 py-2 text-sm text-zinc-100 focus:outline-none focus:border-gold-400">
                                    <option value="pending"    {{ $order->order_status == 'pending'    ? 'selected' : '' }}>🕐 Menunggu Pembayaran</option>
                                    <option value="confirmed"  {{ $order->order_status == 'confirmed'  ? 'selected' : '' }}>✅ Pembayaran Dikonfirmasi</option>
                                    <option value="packed"     {{ $order->order_status == 'packed'     ? 'selected' : '' }}>📦 Sedang Dikemas</option>
                                    <option value="shipped"    {{ $order->order_status == 'shipped'    ? 'selected' : '' }}>🚚 Pesanan Dikirim</option>
                                    <option value="in_transit" {{ $order->order_status == 'in_transit' ? 'selected' : '' }}>📍 Dalam Pengiriman</option>
                                    <option value="delivered"  {{ $order->order_status == 'delivered'  ? 'selected' : '' }}>🎉 Pesanan Diterima</option>
                                    <option value="cancelled"  {{ $order->order_status == 'cancelled'  ? 'selected' : '' }}>❌ Dibatalkan</option>
                                </select>
                            </div>

                            {{-- Courier --}}
                            <div>
                                <label class="block text-[10px] text-zinc-500 uppercase tracking-widest mb-1.5">Kurir / Ekspedisi</label>
                                <select name="courier"
                                    class="w-full bg-onyx-900 border border-zinc-700 rounded-lg px-3 py-2 text-sm text-zinc-100 focus:outline-none focus:border-gold-400">
                                    <option value="">— Pilih Kurir —</option>
                                    @foreach(['JNE','J&T Express','SiCepat','Anteraja','Pos Indonesia','GoSend','GrabExpress','Ninja Xpress','Lion Parcel'] as $kurir)
                                    <option value="{{ $kurir }}" {{ $order->courier == $kurir ? 'selected' : '' }}>{{ $kurir }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Resi Number --}}
                            <div>
                                <label class="block text-[10px] text-zinc-500 uppercase tracking-widest mb-1.5">Nomor Resi</label>
                                <input type="text" name="resi_number" value="{{ $order->resi_number }}"
                                    placeholder="Contoh: JNE123456789"
                                    class="w-full bg-onyx-900 border border-zinc-700 rounded-lg px-3 py-2 text-sm text-zinc-100 font-mono focus:outline-none focus:border-gold-400 placeholder-zinc-600">
                            </div>

                            {{-- Estimated Delivery --}}
                            <div>
                                <label class="block text-[10px] text-zinc-500 uppercase tracking-widest mb-1.5">Estimasi Tiba</label>
                                <input type="date" name="estimated_delivery"
                                    value="{{ $order->estimated_delivery ? $order->estimated_delivery->format('Y-m-d') : '' }}"
                                    class="w-full bg-onyx-900 border border-zinc-700 rounded-lg px-3 py-2 text-sm text-zinc-100 focus:outline-none focus:border-gold-400">
                            </div>
                        </div>

                        {{-- Note --}}
                        <div>
                            <label class="block text-[10px] text-zinc-500 uppercase tracking-widest mb-1.5">Catatan Tracking (opsional)</label>
                            <input type="text" name="tracking_note"
                                placeholder="Contoh: Paket telah diterima di gudang Jakarta"
                                class="w-full bg-onyx-900 border border-zinc-700 rounded-lg px-3 py-2 text-sm text-zinc-100 focus:outline-none focus:border-gold-400 placeholder-zinc-600">
                        </div>

                        <button type="submit"
                            class="w-full md:w-auto px-6 py-2.5 bg-gold-400 hover:bg-gold-300 text-onyx-900 font-bold text-xs rounded-lg transition-colors tracking-wide uppercase">
                            🚀 Update Status Tracking
                        </button>
                    </form>
                </div>

                {{-- Tracking Preview --}}
                <div class="p-4">
                    <p class="text-[10px] text-zinc-500 uppercase tracking-widest mb-4">Preview Timeline (tampilan pelanggan)</p>
                    <div class="space-y-0">
                        @foreach($order->tracking_timeline as $step)
                        <div class="flex gap-3 {{ !$loop->last ? 'pb-5' : '' }} relative">
                            @if(!$loop->last)
                            <div class="absolute left-4 top-8 bottom-0 w-px {{ $step['done'] || $step['active'] ? 'bg-gold-400/40' : 'bg-zinc-800' }}"></div>
                            @endif
                            <div class="relative z-10 w-8 h-8 rounded-full border flex items-center justify-center text-xs flex-shrink-0
                                {{ $step['active'] ? 'border-gold-400 bg-gold-400 text-onyx-900 font-bold shadow-lg shadow-gold-400/20' : ($step['done'] ? 'border-zinc-600 bg-zinc-700 text-zinc-300' : 'border-zinc-800 bg-onyx-900 text-zinc-700') }}">
                                {{ $step['done'] ? '✓' : $step['icon'] }}
                            </div>
                            <div class="flex-1 pb-1">
                                <div class="flex justify-between items-start">
                                    <p class="text-xs font-semibold {{ $step['active'] ? 'text-gold-300' : ($step['done'] ? 'text-zinc-300' : 'text-zinc-700') }}">
                                        {{ $step['label'] }}
                                        @if($step['active'])<span class="ml-1 text-[9px] bg-gold-400/20 text-gold-300 px-1.5 py-0.5 rounded-full">SEKARANG</span>@endif
                                    </p>
                                    @if($step['timestamp'])
                                    <span class="text-[10px] text-zinc-600 ml-2 whitespace-nowrap">{{ $step['timestamp'] }}</span>
                                    @endif
                                </div>
                                <p class="text-[11px] text-zinc-600 mt-0.5">{{ $step['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Link to public tracking page --}}
                    <div class="mt-5 pt-4 border-t border-zinc-800">
                        <a href="{{ route('tracking.show', $order->order_number) }}" target="_blank"
                           class="inline-flex items-center gap-2 text-xs text-gold-400 hover:text-gold-300 underline-offset-2 hover:underline">
                            🔗 Lihat Halaman Tracking Pelanggan &rarr;
                        </a>
                    </div>
                </div>
            </div>

            {{-- Payment Status Update --}}
            <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-4">
                <h3 class="text-sm font-semibold text-zinc-100 mb-3">💳 Update Status Pembayaran</h3>
                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="flex items-center gap-3 flex-wrap">
                    @csrf
                    @method('PATCH')
                    <select name="payment_status"
                        class="bg-onyx-900 border border-zinc-700 rounded-lg px-3 py-2 text-xs text-zinc-100 focus:outline-none focus:border-gold-400">
                        <option value="pending"    {{ $order->payment_status == 'pending'    ? 'selected' : '' }}>⏳ Pending</option>
                        <option value="reviewing"  {{ $order->payment_status == 'reviewing'  ? 'selected' : '' }}>🔍 Verifikasi Bukti</option>
                        <option value="paid"       {{ $order->payment_status == 'paid'       ? 'selected' : '' }}>✅ Lunas (Paid)</option>
                        <option value="expired"    {{ $order->payment_status == 'expired'    ? 'selected' : '' }}>⌛ Kadaluarsa</option>
                        <option value="cancelled"  {{ $order->payment_status == 'cancelled'  ? 'selected' : '' }}>❌ Dibatalkan</option>
                    </select>
                    <button type="submit"
                        class="px-4 py-2 bg-zinc-700 hover:bg-zinc-600 text-zinc-100 text-xs rounded-lg font-semibold transition-colors">
                        Perbarui Pembayaran
                    </button>
                    @if($order->payment_status === 'paid')
                    <span class="text-xs text-zinc-500">Lunas: {{ $order->paid_at?->format('d M Y, H:i') }} WIB</span>
                    @endif
                </form>

                {{-- Payment Proof --}}
                @if($order->payment_proof)
                <div class="mt-4 pt-4 border-t border-zinc-800">
                    <p class="text-[10px] text-zinc-500 uppercase tracking-widest mb-2">Bukti Transfer Pelanggan</p>
                    <a href="{{ $order->payment_proof }}" target="_blank" class="block group relative overflow-hidden rounded-lg border border-zinc-700 max-w-xs">
                        <img src="{{ $order->payment_proof }}" alt="Bukti Transfer"
                             class="w-full object-cover max-h-60 group-hover:scale-105 transition-transform">
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex items-center justify-center text-xs text-gold-300 font-medium transition-opacity">
                            Klik untuk perbesar &rarr;
                        </div>
                    </a>
                </div>
                @endif
            </div>

        </div>

        {{-- ===== RIGHT COLUMN ===== --}}
        <div class="space-y-5">

            {{-- Customer Info --}}
            <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-5 space-y-3">
                <h3 class="text-sm font-semibold text-zinc-100 pb-2 border-b border-zinc-800">👤 Informasi Pembeli</h3>
                <div class="space-y-2.5 text-xs">
                    <div>
                        <div class="text-zinc-500 uppercase tracking-widest text-[10px]">Nama</div>
                        <div class="text-zinc-100 font-medium">{{ $order->customer_name }}</div>
                    </div>
                    <div>
                        <div class="text-zinc-500 uppercase tracking-widest text-[10px]">WhatsApp</div>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}?text=Halo%20{{ urlencode($order->customer_name) }}%2C%20pesanan%20Anda%20{{ $order->order_number }}"
                           target="_blank"
                           class="text-emerald-400 hover:underline flex items-center gap-1 font-mono">
                            {{ $order->customer_phone }}
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </div>
                    <div>
                        <div class="text-zinc-500 uppercase tracking-widest text-[10px]">Email</div>
                        <div class="text-zinc-300 font-mono break-all">{{ $order->customer_email }}</div>
                    </div>
                    <div>
                        <div class="text-zinc-500 uppercase tracking-widest text-[10px]">Metode Bayar</div>
                        <div class="text-zinc-300">{{ $order->payment_method_label }}</div>
                    </div>
                </div>
            </div>

            {{-- Shipping Address --}}
            <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-5">
                <h3 class="text-sm font-semibold text-zinc-100 pb-2 border-b border-zinc-800 mb-3">📍 Alamat Kirim</h3>
                <div class="text-xs text-zinc-300 space-y-1">
                    <p class="leading-relaxed">{{ $order->customer_address }}</p>
                    <p class="text-zinc-400">{{ $order->customer_city }}@if($order->customer_province), {{ $order->customer_province }}@endif @if($order->customer_postal_code){{ $order->customer_postal_code }}@endif</p>
                    @if($order->customer_notes)
                    <div class="mt-2 p-2 rounded bg-onyx-900 border border-zinc-800 text-zinc-500">
                        <span class="text-gold-400 font-medium">Catatan:</span> {{ $order->customer_notes }}
                    </div>
                    @endif
                </div>
            </div>

            {{-- Resi Info --}}
            @if($order->resi_number)
            <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-5">
                <h3 class="text-sm font-semibold text-zinc-100 pb-2 border-b border-zinc-800 mb-3">📮 Info Pengiriman</h3>
                <div class="text-xs space-y-2">
                    <div><span class="text-zinc-500">Kurir:</span> <span class="text-zinc-200 font-semibold">{{ $order->courier }}</span></div>
                    <div><span class="text-zinc-500">Resi:</span> <span class="text-gold-300 font-mono font-bold">{{ $order->resi_number }}</span></div>
                    @if($order->estimated_delivery)
                    <div><span class="text-zinc-500">Est. Tiba:</span> <span class="text-zinc-200">{{ $order->estimated_delivery->format('d M Y') }}</span></div>
                    @endif
                </div>
            </div>
            @endif

            {{-- Quick Links --}}
            <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-4 space-y-2">
                <a href="{{ route('order.invoice', $order->order_number) }}" target="_blank"
                   class="w-full flex items-center justify-center gap-2 py-2.5 bg-zinc-800 hover:bg-zinc-700 text-zinc-200 text-xs rounded-lg border border-zinc-700 transition-colors font-medium">
                    🧾 Cetak Invoice
                </a>
                <a href="{{ route('tracking.show', $order->order_number) }}" target="_blank"
                   class="w-full flex items-center justify-center gap-2 py-2.5 bg-zinc-800 hover:bg-zinc-700 text-zinc-200 text-xs rounded-lg border border-zinc-700 transition-colors font-medium">
                    🗺️ Preview Tracking Pelanggan
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
