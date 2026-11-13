@extends('admin.layout')

@section('title', 'Kategori & Famille Olfactive')
@section('page_title', 'Famille Olfactive & Kategori')
@section('page_subtitle', 'Klasifikasi koleksi parfum mewah ZEEN')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Column 1: Add New Category Form -->
    <div class="lg:col-span-1">
        <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-5 sticky top-6">
            <h3 class="text-sm font-semibold text-zinc-100 mb-1 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-gold-400"></span>
                <span>Tambah Kategori Baru</span>
            </h3>
            <p class="text-xs text-zinc-400 mb-4">Buat kelompok aroma baru untuk etalase.</p>

            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-3.5">
                @csrf

                <div>
                    <label class="block text-xs uppercase tracking-wider text-zinc-400 mb-1 font-medium">Nama Kategori *</label>
                    <input type="text" name="name" required placeholder="Contoh: Oud & Amber Elixirs"
                           class="w-full bg-onyx-900 border border-zinc-700/80 rounded-lg px-3 py-2 text-xs text-zinc-100 focus:outline-none focus:border-gold-400">
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-wider text-zinc-400 mb-1 font-medium">Sub-title / Deskripsi Singkat</label>
                    <input type="text" name="subtitle" placeholder="Contoh: 35% Pure Perfume Oil"
                           class="w-full bg-onyx-900 border border-zinc-700/80 rounded-lg px-3 py-2 text-xs text-zinc-100 focus:outline-none focus:border-gold-400">
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-wider text-zinc-400 mb-1 font-medium">URL Gambar Kategori</label>
                    <input type="url" name="image" placeholder="https://images.unsplash.com/..."
                           class="w-full bg-onyx-900 border border-zinc-700/80 rounded-lg px-3 py-2 text-xs text-zinc-100 focus:outline-none focus:border-gold-400 font-mono">
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-wider text-zinc-400 mb-1 font-medium">Deskripsi Lengkap</label>
                    <textarea name="description" rows="2" placeholder="Penjelasan karakter kelompok aroma ini..."
                              class="w-full bg-onyx-900 border border-zinc-700/80 rounded-lg p-2.5 text-xs text-zinc-100 focus:outline-none focus:border-gold-400"></textarea>
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-wider text-zinc-400 mb-1 font-medium">Nomor Urutan Tampil</label>
                    <input type="number" name="order_position" value="1" min="1"
                           class="w-full bg-onyx-900 border border-zinc-700/80 rounded-lg px-3 py-2 text-xs text-zinc-100 focus:outline-none focus:border-gold-400 font-mono">
                </div>

                <div class="pt-1">
                    <label class="flex items-center gap-2 cursor-pointer text-xs text-zinc-300">
                        <input type="checkbox" name="is_active" value="1" checked class="rounded bg-onyx-900 border-zinc-700 text-gold-500 focus:ring-0">
                        <span>Aktifkan di menu toko</span>
                    </label>
                </div>

                <button type="submit"
                        class="w-full mt-2 py-2.5 bg-gradient-to-r from-gold-500 to-gold-400 hover:from-gold-400 hover:to-gold-300 text-onyx-900 font-semibold text-xs tracking-wider uppercase rounded-lg shadow-md transition-all">
                    Simpan Kategori
                </button>
            </form>
        </div>
    </div>

    <!-- Column 2: Categories List -->
    <div class="lg:col-span-2">
        <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl overflow-hidden shadow-xl">
            <div class="p-4 border-b border-zinc-800/80">
                <h3 class="text-sm font-semibold text-zinc-100">Daftar Kategori Terdaftar</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-onyx-900 text-zinc-400 uppercase tracking-wider text-[10px] border-b border-zinc-800">
                        <tr>
                            <th class="py-3 px-4">Urutan</th>
                            <th class="py-3 px-4">Kategori</th>
                            <th class="py-3 px-4">Jumlah Parfum</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800/60">
                        @forelse ($categories as $cat)
                            <tr class="hover:bg-zinc-800/30 transition-colors">
                                <td class="py-3.5 px-4 font-mono text-gold-400 font-bold">
                                    #{{ $cat->order_position }}
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center gap-3">
                                        @if ($cat->image)
                                            <img src="{{ $cat->image }}" alt="{{ $cat->name }}" class="w-10 h-10 object-cover rounded border border-zinc-800 shrink-0">
                                        @endif
                                        <div>
                                            <div class="font-medium text-zinc-100">{{ $cat->name }}</div>
                                            <div class="text-[11px] text-zinc-500">{{ $cat->subtitle ?? $cat->slug }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="inline-flex px-2 py-0.5 rounded text-[11px] font-medium bg-zinc-800 text-zinc-300 border border-zinc-700">
                                        {{ $cat->products_count }} Parfum
                                    </span>
                                </td>
                                <td class="py-3.5 px-4">
                                    @if ($cat->is_active)
                                        <span class="text-emerald-400 font-medium">Aktif</span>
                                    @else
                                        <span class="text-zinc-500">Non-aktif</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-right">
                                    <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST"
                                          onsubmit="return confirm('Hapus kategori \'{{ $cat->name }}\'?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 text-xs text-rose-400 hover:text-rose-300 hover:bg-rose-950/40 rounded transition-colors"
                                                {{ $cat->products_count > 0 ? 'title=Kategori-masih-memiliki-produk disabled opacity-40' : '' }}>
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-zinc-500">
                                    Belum ada kategori yang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

