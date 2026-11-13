@extends('admin.layout')

@section('title', 'Manajemen Pesanan')
@section('page_title', 'Pesanan & Transaksi')
@section('page_subtitle', 'Pantau pembayaran QRIS, Virtual Account, konfirmasi bukti transfer, dan status pengiriman')

@section('content')
<div class="space-y-5">

    <!-- Filters & Status Tabs -->
    <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-4 flex flex-col md:flex-row gap-4 items-center justify-between">
        <!-- Status Tabs -->
        <div class="flex items-center gap-1.5 overflow-x-auto w-full md:w-auto pb-1 md:pb-0 text-xs">
            <a href="{{ route('admin.orders.index') }}"
               class="px-3 py-1.5 rounded-lg transition-colors whitespace-nowrap {{ !request('status') ? 'bg-gold-400 text-onyx-900 font-semibold' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-800' }}">
                Semua
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}"
               class="px-3 py-1.5 rounded-lg transition-colors whitespace-nowrap {{ request('status') == 'pending' ? 'bg-amber-500/20 text-amber-300 font-semibold border border-amber-500/40' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-800' }}">
                Menunggu Bayar
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'reviewing']) }}"
               class="px-3 py-1.5 rounded-lg transition-colors whitespace-nowrap {{ request('status') == 'reviewing' ? 'bg-blue-500/20 text-blue-300 font-semibold border border-blue-500/40' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-800' }}">
                Periksa Bukti
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'paid']) }}"
               class="px-3 py-1.5 rounded-lg transition-colors whitespace-nowrap {{ request('status') == 'paid' ? 'bg-emerald-500/20 text-emerald-300 font-semibold border border-emerald-500/40' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-800' }}">
                Lunas (Paid)
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'cancelled']) }}"
               class="px-3 py-1.5 rounded-lg transition-colors whitespace-nowrap {{ request('status') == 'cancelled' ? 'bg-zinc-700 text-zinc-200 font-semibold' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-800' }}">
                Dibatalkan
            </a>
        </div>

        <!-- Search Order -->
        <form method="GET" action="{{ route('admin.orders.index') }}" class="w-full md:w-72">
            @if (request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari No. Order, Nama, WA..."
                       class="w-full bg-onyx-900 border border-zinc-700/80 rounded-lg pl-9 pr-3 py-2 text-xs text-zinc-100 placeholder-zinc-500 focus:outline-none focus:border-gold-400">
                <svg class="w-4 h-4 text-zinc-500 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
        </form>
    </div>

    <!-- Orders Table -->
    <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-onyx-900 text-zinc-400 uppercase tracking-wider text-[10px] border-b border-zinc-800">
                    <tr>
                        <th class="py-3 px-5">Nomor Pesanan</th>
                        <th class="py-3 px-5">Pelanggan</th>
                        <th class="py-3 px-4">Metode Bayar</th>
                        <th class="py-3 px-4">Total</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Tanggal Masuk</th>
                        <th class="py-3 px-5 text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800/60">
                    @forelse ($orders as $order)
                        <tr class="hover:bg-zinc-800/30 transition-colors">
                            <td class="py-3.5 px-5">
                                <a href="{{ route('admin.orders.show', $order) }}" class="font-mono font-semibold text-gold-300 hover:underline">
                                    {{ $order->order_number }}
                                </a>
                                <div class="text-[10px] text-zinc-500 mt-0.5">
                                    {{ $order->items->count() }} item parfum
                                </div>
                            </td>

                            <td class="py-3.5 px-5">
                                <div class="font-medium text-zinc-200">{{ $order->customer_name }}</div>
                                <div class="text-[10px] text-zinc-400">{{ $order->customer_phone }}</div>
                                <div class="text-[10px] text-zinc-500 truncate max-w-[200px]">{{ $order->customer_city }}</div>
                            </td>

                            <td class="py-3.5 px-4">
                                <span class="uppercase text-[11px] text-zinc-300 font-mono">{{ $order->payment_method }}</span>
                                @if ($order->payment_proof)
                                    <span class="block text-[9px] text-blue-400 mt-0.5 font-medium">Bukti Diupload</span>
                                @endif
                            </td>

                            <td class="py-3.5 px-4 font-serif-lux font-semibold text-zinc-100 text-sm">
                                {{ $order->formatted_total }}
                            </td>

                            <td class="py-3.5 px-4">
                                @if ($order->payment_status === 'paid')
                                    <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                        LUNAS (PAID)
                                    </span>
                                @elseif ($order->payment_status === 'reviewing')
                                    <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-semibold bg-blue-500/10 text-blue-400 border border-blue-500/20 animate-pulse">
                                        CEK BUKTI BAYAR
                                    </span>
                                @elseif ($order->payment_status === 'cancelled')
                                    <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-semibold bg-zinc-800 text-zinc-400 border border-zinc-700">
                                        BATAL
                                    </span>
                                @else
                                    <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                        PENDING
                                    </span>
                                @endif
                            </td>

                            <td class="py-3.5 px-4 text-zinc-400 text-[11px]">
                                <div>{{ $order->created_at->format('d M Y') }}</div>
                                <div class="text-[10px] text-zinc-500">{{ $order->created_at->format('H:i') }} WIB</div>
                            </td>

                            <td class="py-3.5 px-5 text-right whitespace-nowrap">
                                <a href="{{ route('admin.orders.show', $order) }}"
                                   class="px-3 py-1.5 bg-zinc-800 hover:bg-gold-400 hover:text-onyx-900 text-zinc-200 rounded text-xs transition-colors border border-zinc-700 font-medium">
                                    Detail &rarr;
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-zinc-500">
                                Belum ada pesanan pada status ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($orders->hasPages())
            <div class="px-6 py-4 border-t border-zinc-800/80 bg-onyx-900/40">
                {{ $orders->links() }}
            </div>
        @endif
    </div>

</div>
@endsection

