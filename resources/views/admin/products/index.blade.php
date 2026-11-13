@extends('admin.layout')

@section('title', 'Katalog Parfum')
@section('page_title', 'Katalog Parfum')
@section('page_subtitle', 'Kelola koleksi Haute Parfumerie, harga, stok, dan deskripsi aroma')

@section('actions')
    <a href="{{ route('admin.products.create') }}" class="hidden sm:inline-flex items-center gap-2 bg-gold-400 hover:bg-gold-300 text-onyx-900 font-semibold px-4 py-2 rounded-lg text-xs tracking-wider transition-all">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v16m8-8H4"/></svg>
        <span>Tambah Parfum Baru</span>
    </a>
@endsection

@section('content')
<div class="space-y-5">

    <!-- Filters & Search Bar -->
    <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-4 flex flex-col md:flex-row gap-3 items-center justify-between">
        <form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-wrap items-center gap-3 w-full md:w-auto">
            <!-- Search Input -->
            <div class="relative w-full sm:w-64">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama parfum..."
                       class="w-full bg-onyx-900 border border-zinc-700/80 rounded-lg pl-9 pr-3 py-2 text-xs text-zinc-100 placeholder-zinc-500 focus:outline-none focus:border-gold-400">
                <svg class="w-4 h-4 text-zinc-500 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>

            <!-- Category Filter -->
            <select name="category_id" onchange="this.form.submit()"
                    class="bg-onyx-900 border border-zinc-700/80 rounded-lg px-3 py-2 text-xs text-zinc-200 focus:outline-none focus:border-gold-400">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="px-3.5 py-2 bg-zinc-800 hover:bg-zinc-700 text-zinc-200 text-xs rounded-lg border border-zinc-700">
                Filter
            </button>

            @if (request()->hasAny(['search', 'category_id']))
                <a href="{{ route('admin.products.index') }}" class="text-xs text-zinc-500 hover:text-zinc-300">
                    Reset
                </a>
            @endif
        </form>

        <div class="text-xs text-zinc-400 shrink-0">
            Total: <span class="text-gold-300 font-semibold">{{ $products->total() }}</span> parfum
        </div>
    </div>

    <!-- Products Table -->
    <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-onyx-900 text-zinc-400 uppercase tracking-wider text-[10px] border-b border-zinc-800">
                    <tr>
                        <th class="py-3 px-5">Parfum</th>
                        <th class="py-3 px-4">Kategori & Olfactory</th>
                        <th class="py-3 px-4">Harga</th>
                        <th class="py-3 px-4">Stok</th>
                        <th class="py-3 px-4">Badges</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800/60">
                    @forelse ($products as $p)
                        <tr class="hover:bg-zinc-800/30 transition-colors">
                            <!-- Image & Name -->
                            <td class="py-3.5 px-5">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $p->image }}" alt="{{ $p->name }}"
                                         class="w-12 h-14 object-cover rounded border border-zinc-800 bg-onyx-900 shrink-0"
                                         onerror="this.src='https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?auto=format&fit=crop&w=200&q=80'">
                                    <div class="min-w-0">
                                        <div class="font-serif-lux font-semibold text-zinc-100 text-sm truncate">{{ $p->name }}</div>
                                        <div class="text-[11px] text-gold-400 truncate">{{ $p->subtitle ?? $p->concentration }}</div>
                                        <a href="{{ route('products.show', $p->slug) }}" target="_blank" class="text-[10px] text-zinc-500 hover:text-zinc-300 inline-flex items-center gap-0.5 mt-0.5">
                                            <span>Lihat di Toko</span>
                                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </td>

                            <!-- Category & Olfactory Family -->
                            <td class="py-3.5 px-4">
                                <div class="text-zinc-200 font-medium">{{ $p->category->name ?? '-' }}</div>
                                <div class="text-[11px] text-zinc-400">{{ $p->fragrance_family ?? '-' }}</div>
                            </td>

                            <!-- Price -->
                            <td class="py-3.5 px-4">
                                <div class="font-serif-lux font-semibold text-zinc-100 text-sm">
                                    Rp {{ number_format($p->price, 0, ',', '.') }}
                                </div>
                                @if ($p->original_price && $p->original_price > $p->price)
                                    <div class="text-[10px] text-zinc-500 line-through">
                                        Rp {{ number_format($p->original_price, 0, ',', '.') }}
                                    </div>
                                @endif
                            </td>

                            <!-- Stock -->
                            <td class="py-3.5 px-4">
                                @if ($p->stock <= 0)
                                    <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-bold bg-rose-500/10 text-rose-400 border border-rose-500/20">
                                        HABIS
                                    </span>
                                @elseif ($p->stock <= 5)
                                    <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-bold bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                        {{ $p->stock }} Tersisa
                                    </span>
                                @else
                                    <span class="text-zinc-300 font-medium">{{ $p->stock }} unit</span>
                                @endif
                            </td>

                            <!-- Badges -->
                            <td class="py-3.5 px-4">
                                <div class="flex flex-wrap gap-1">
                                    @if ($p->badge)
                                        <span class="px-1.5 py-0.5 rounded text-[9px] font-semibold bg-gold-400/20 text-gold-300 border border-gold-400/30 uppercase">
                                            {{ $p->badge }}
                                        </span>
                                    @endif
                                    @if ($p->is_featured)
                                        <span class="px-1.5 py-0.5 rounded text-[9px] font-medium bg-purple-500/10 text-purple-300 border border-purple-500/20">
                                            Unggulan
                                        </span>
                                    @endif
                                    @if ($p->is_bestseller)
                                        <span class="px-1.5 py-0.5 rounded text-[9px] font-medium bg-blue-500/10 text-blue-300 border border-blue-500/20">
                                            Bestseller
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <!-- Status -->
                            <td class="py-3.5 px-4">
                                @if ($p->is_active)
                                    <span class="inline-flex items-center gap-1.5 text-emerald-400 text-xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                        <span>Aktif</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 text-zinc-500 text-xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>
                                        <span>Non-aktif</span>
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="py-3.5 px-5 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.products.edit', $p) }}"
                                       class="px-2.5 py-1.5 bg-zinc-800 hover:bg-gold-400 hover:text-onyx-900 text-zinc-200 rounded text-xs transition-colors border border-zinc-700">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.products.destroy', $p) }}" method="POST"
                                          onsubmit="return confirm('Hapus parfum \'{{ $p->name }}\' dari katalog?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1.5 bg-zinc-800 hover:bg-rose-900/60 text-zinc-400 hover:text-rose-300 rounded text-xs transition-colors border border-zinc-700">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-zinc-500">
                                Tidak ada data parfum yang sesuai pencarian.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($products->hasPages())
            <div class="px-6 py-4 border-t border-zinc-800/80 bg-onyx-900/40">
                {{ $products->links() }}
            </div>
        @endif
    </div>

</div>
@endsection

