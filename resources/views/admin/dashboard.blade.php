@extends('admin.layout')

@section('title', 'Dashboard Atelier')
@section('page_title', 'Dashboard Atelier')
@section('page_subtitle', 'Ringkasan performa penjualan dan inventaris parfum mewah ZEEN')

@section('content')
<div class="space-y-6">

    <!-- KPI Metrics Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Sales -->
        <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-5 relative overflow-hidden">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs uppercase tracking-wider text-zinc-400 font-medium">Total Omset (Paid)</span>
                <div class="p-2 rounded-lg bg-emerald-500/10 text-emerald-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="text-xl font-semibold text-zinc-100 font-serif-lux">
                Rp {{ number_format($totalSales, 0, ',', '.') }}
            </div>
            <p class="text-[11px] text-zinc-500 mt-1">Pendapatan bersih terverifikasi</p>
        </div>

        <!-- Total Orders -->
        <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-5 relative overflow-hidden">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs uppercase tracking-wider text-zinc-400 font-medium">Total Pesanan</span>
                <div class="p-2 rounded-lg bg-blue-500/10 text-blue-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
            </div>
            <div class="text-2xl font-semibold text-zinc-100">
                {{ $totalOrders }}
            </div>
            <p class="text-[11px] text-zinc-500 mt-1">Seluruh riwayat transaksi</p>
        </div>

        <!-- Pending Orders -->
        <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-5 relative overflow-hidden">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs uppercase tracking-wider text-zinc-400 font-medium">Menunggu Bayar</span>
                <div class="p-2 rounded-lg bg-amber-500/10 text-amber-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="text-2xl font-semibold text-amber-300">
                {{ $pendingOrders }}
            </div>
            <p class="text-[11px] text-zinc-500 mt-1">Pending / Butuh verifikasi</p>
        </div>

        <!-- Total Active Products -->
        <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-5 relative overflow-hidden">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs uppercase tracking-wider text-zinc-400 font-medium">Parfum Aktif</span>
                <div class="p-2 rounded-lg bg-gold-400/10 text-gold-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
            </div>
            <div class="text-2xl font-semibold text-zinc-100">
                {{ $totalProducts }}
            </div>
            <p class="text-[11px] text-zinc-500 mt-1">Tersedia di etalase toko</p>
        </div>
    </div>

    <!-- Quick Shortcuts Banner -->
    <div class="bg-gradient-to-r from-onyx-800 via-onyx-850 to-onyx-800 border border-gold-400/20 rounded-xl p-5 flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-gold-400/10 border border-gold-400/30 flex items-center justify-center text-gold-400 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-zinc-100">Pusat Manajemen Konten & Katalog</h3>
                <p class="text-xs text-zinc-400">Tambah parfum baru, ubah piramida aroma, harga, stok, atau cek bukti transfer pelanggan.</p>
            </div>
        </div>
        <div class="flex items-center gap-2.5 shrink-0">
            <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-gold-400 text-onyx-900 font-semibold text-xs rounded-lg hover:bg-gold-300 transition-colors">
                + Tambah Parfum
            </a>
            <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-zinc-800 text-zinc-200 hover:text-white font-medium text-xs rounded-lg hover:bg-zinc-700 transition-colors border border-zinc-700">
                Kelola Kategori
            </a>
            <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-zinc-800 text-zinc-200 hover:text-white font-medium text-xs rounded-lg hover:bg-zinc-700 transition-colors border border-zinc-700">
                Lihat Semua Pesanan
            </a>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl overflow-hidden">
        <div class="px-6 py-4 border-b border-zinc-800/80 flex items-center justify-between">
            <div>
                <h2 class="text-sm font-semibold text-zinc-100">Pesanan Terbaru</h2>
                <p class="text-xs text-zinc-500">Daftar transaksi pelanggan terkini</p>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="text-xs text-gold-400 hover:underline">
                Lihat Semua Pesanan &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-onyx-900 text-zinc-400 uppercase tracking-wider text-[10px] border-b border-zinc-800">
                    <tr>
                        <th class="py-3 px-6">No. Pesanan</th>
                        <th class="py-3 px-6">Pelanggan</th>
                        <th class="py-3 px-6">Metode</th>
                        <th class="py-3 px-6">Total Tagihan</th>
                        <th class="py-3 px-6">Status Bayar</th>
                        <th class="py-3 px-6">Waktu</th>
                        <th class="py-3 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800/60">
                    @forelse ($recentOrders as $order)
                        <tr class="hover:bg-zinc-800/30 transition-colors">
                            <td class="py-3.5 px-6 font-mono text-zinc-300 font-semibold">
                                <a href="{{ route('admin.orders.show', $order) }}" class="hover:text-gold-300">
                                    {{ $order->order_number }}
                                </a>
                            </td>
                            <td class="py-3.5 px-6">
                                <div class="font-medium text-zinc-200">{{ $order->customer_name }}</div>
                                <div class="text-[10px] text-zinc-500">{{ $order->customer_phone }}</div>
                            </td>
                            <td class="py-3.5 px-6 uppercase text-[11px] text-zinc-400">
                                {{ $order->payment_method }}
                            </td>
                            <td class="py-3.5 px-6 font-medium text-zinc-200 font-serif-lux">
                                {{ $order->formatted_total }}
                            </td>
                            <td class="py-3.5 px-6">
                                @if ($order->payment_status === 'paid')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                        LUNAS (PAID)
                                    </span>
                                @elseif ($order->payment_status === 'reviewing')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                        VERIFIKASI BUKTI
                                    </span>
                                @elseif ($order->payment_status === 'cancelled')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold bg-zinc-800 text-zinc-400 border border-zinc-700">
                                        DIBATALKAN
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                        MENUNGGU
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-6 text-zinc-500 text-[11px]">
                                {{ $order->created_at->diffForHumans() }}
                            </td>
                            <td class="py-3.5 px-6 text-right">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-gold-400 hover:text-gold-300 font-medium">
                                    Detail &rarr;
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-zinc-500">
                                Belum ada pesanan yang masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

