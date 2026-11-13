@extends('admin.layout')

@section('title', 'Edit Parfum: ' . $product->name)
@section('page_title', 'Perbarui Formula: ' . $product->name)
@section('page_subtitle', 'Ubah detail formula, harga, piramida aroma, dan stok inventaris')

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.products.update', $product) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Card 1: Informasi Dasar -->
        <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-6 space-y-4">
            <h3 class="text-sm font-semibold text-zinc-100 flex items-center gap-2 pb-2 border-b border-zinc-800">
                <span class="w-2 h-2 rounded-full bg-gold-400"></span>
                <span>1. Identitas & Kategori Parfum</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-xs uppercase tracking-wider text-zinc-400 mb-1.5 font-medium">Nama Parfum *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                           class="w-full bg-onyx-900 border border-zinc-700/80 rounded-lg px-3.5 py-2.5 text-sm text-zinc-100 focus:outline-none focus:border-gold-400 font-serif-lux">
                    @error('name') <span class="text-xs text-rose-400">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-wider text-zinc-400 mb-1.5 font-medium">Sub-title / Tagline Aroma</label>
                    <input type="text" name="subtitle" value="{{ old('subtitle', $product->subtitle) }}"
                           class="w-full bg-onyx-900 border border-zinc-700/80 rounded-lg px-3.5 py-2 text-xs text-zinc-100 focus:outline-none focus:border-gold-400">
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-wider text-zinc-400 mb-1.5 font-medium">Kategori Koleksi *</label>
                    <select name="category_id" required
                            class="w-full bg-onyx-900 border border-zinc-700/80 rounded-lg px-3.5 py-2 text-xs text-zinc-200 focus:outline-none focus:border-gold-400">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-wider text-zinc-400 mb-1.5 font-medium">Konsentrasi Minyak Parfum</label>
                    <input type="text" name="concentration" value="{{ old('concentration', $product->concentration) }}"
                           class="w-full bg-onyx-900 border border-zinc-700/80 rounded-lg px-3.5 py-2 text-xs text-zinc-100 focus:outline-none focus:border-gold-400">
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-wider text-zinc-400 mb-1.5 font-medium">Fragrance Family</label>
                    <select name="fragrance_family" class="w-full bg-onyx-900 border border-zinc-700/80 rounded-lg px-3.5 py-2 text-xs text-zinc-200 focus:outline-none focus:border-gold-400">
                        <option value="Woody & Oud" {{ old('fragrance_family', $product->fragrance_family) == 'Woody & Oud' ? 'selected' : '' }}>Woody & Oud</option>
                        <option value="Warm Amber & Vanilla" {{ old('fragrance_family', $product->fragrance_family) == 'Warm Amber & Vanilla' ? 'selected' : '' }}>Warm Amber & Vanilla</option>
                        <option value="Floral & Solar" {{ old('fragrance_family', $product->fragrance_family) == 'Floral & Solar' ? 'selected' : '' }}>Floral & Solar</option>
                        <option value="Fresh & Aquatic" {{ old('fragrance_family', $product->fragrance_family) == 'Fresh & Aquatic' ? 'selected' : '' }}>Fresh & Aquatic</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Card 2: Harga & Stok -->
        <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-6 space-y-4">
            <h3 class="text-sm font-semibold text-zinc-100 flex items-center gap-2 pb-2 border-b border-zinc-800">
                <span class="w-2 h-2 rounded-full bg-gold-400"></span>
                <span>2. Harga & Inventaris Stok</span>
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs uppercase tracking-wider text-zinc-400 mb-1.5 font-medium">Harga Jual (Rp) *</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" required min="0" step="1000"
                           class="w-full bg-onyx-900 border border-zinc-700/80 rounded-lg px-3.5 py-2 text-xs text-zinc-100 focus:outline-none focus:border-gold-400 font-mono">
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-wider text-zinc-400 mb-1.5 font-medium">Harga Coret Asli</label>
                    <input type="number" name="original_price" value="{{ old('original_price', $product->original_price) }}" min="0" step="1000"
                           class="w-full bg-onyx-900 border border-zinc-700/80 rounded-lg px-3.5 py-2 text-xs text-zinc-100 focus:outline-none focus:border-gold-400 font-mono">
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-wider text-zinc-400 mb-1.5 font-medium">Jumlah Stok (Unit) *</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required min="0"
                           class="w-full bg-onyx-900 border border-zinc-700/80 rounded-lg px-3.5 py-2 text-xs text-zinc-100 focus:outline-none focus:border-gold-400 font-mono">
                </div>
            </div>
        </div>

        <!-- Card 3: Piramida Aroma -->
        <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-6 space-y-4">
            <h3 class="text-sm font-semibold text-zinc-100 flex items-center gap-2 pb-2 border-b border-zinc-800">
                <span class="w-2 h-2 rounded-full bg-gold-400"></span>
                <span>3. Piramida Aroma (Olfactory Pyramid)</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs uppercase tracking-wider text-amber-300 mb-1.5 font-medium">Top Notes (Awal)</label>
                    <input type="text" name="top_notes" value="{{ old('top_notes', $product->top_notes) }}"
                           class="w-full bg-onyx-900 border border-zinc-700/80 rounded-lg px-3.5 py-2 text-xs text-zinc-100 focus:outline-none focus:border-gold-400">
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-wider text-gold-400 mb-1.5 font-medium">Heart Notes (Jiwa)</label>
                    <input type="text" name="heart_notes" value="{{ old('heart_notes', $product->heart_notes) }}"
                           class="w-full bg-onyx-900 border border-zinc-700/80 rounded-lg px-3.5 py-2 text-xs text-zinc-100 focus:outline-none focus:border-gold-400">
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-wider text-amber-500 mb-1.5 font-medium">Base Notes (Jejak)</label>
                    <input type="text" name="base_notes" value="{{ old('base_notes', $product->base_notes) }}"
                           class="w-full bg-onyx-900 border border-zinc-700/80 rounded-lg px-3.5 py-2 text-xs text-zinc-100 focus:outline-none focus:border-gold-400">
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-wider text-zinc-400 mb-1.5 font-medium">Longevity</label>
                    <input type="text" name="longevity" value="{{ old('longevity', $product->longevity) }}"
                           class="w-full bg-onyx-900 border border-zinc-700/80 rounded-lg px-3.5 py-2 text-xs text-zinc-100 focus:outline-none focus:border-gold-400">
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-wider text-zinc-400 mb-1.5 font-medium">Sillage</label>
                    <input type="text" name="sillage" value="{{ old('sillage', $product->sillage) }}"
                           class="w-full bg-onyx-900 border border-zinc-700/80 rounded-lg px-3.5 py-2 text-xs text-zinc-100 focus:outline-none focus:border-gold-400">
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-wider text-zinc-400 mb-1.5 font-medium">Badge Label</label>
                    <input type="text" name="badge" value="{{ old('badge', $product->badge) }}"
                           class="w-full bg-onyx-900 border border-zinc-700/80 rounded-lg px-3.5 py-2 text-xs text-zinc-100 focus:outline-none focus:border-gold-400">
                </div>
            </div>
        </div>

        <!-- Card 4: Visual & Narasi Deskripsi -->
        <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-6 space-y-4">
            <h3 class="text-sm font-semibold text-zinc-100 flex items-center gap-2 pb-2 border-b border-zinc-800">
                <span class="w-2 h-2 rounded-full bg-gold-400"></span>
                <span>4. Visual Botol & Narasi Deskripsi</span>
            </h3>

            <div>
                <label class="block text-xs uppercase tracking-wider text-zinc-400 mb-1.5 font-medium">URL Foto Botol Parfum *</label>
                <input type="url" name="image" value="{{ old('image', $product->image) }}" required
                       class="w-full bg-onyx-900 border border-zinc-700/80 rounded-lg px-3.5 py-2 text-xs text-zinc-100 focus:outline-none focus:border-gold-400 font-mono">
                <div class="mt-2 flex items-center gap-3">
                    <img src="{{ $product->image }}" alt="Preview" class="w-12 h-14 object-cover rounded border border-zinc-800 bg-onyx-900">
                    <span class="text-[11px] text-zinc-500">Pratinjau visual terkini</span>
                </div>
            </div>

            <div>
                <label class="block text-xs uppercase tracking-wider text-zinc-400 mb-1.5 font-medium">Deskripsi Editorial</label>
                <textarea name="description" rows="4"
                          class="w-full bg-onyx-900 border border-zinc-700/80 rounded-lg p-3.5 text-xs text-zinc-100 focus:outline-none focus:border-gold-400 leading-relaxed">{{ old('description', $product->description) }}</textarea>
            </div>
        </div>

        <!-- Card 5: Status Visibilitas -->
        <div class="bg-onyx-850 border border-zinc-800/80 rounded-xl p-6 space-y-3">
            <h3 class="text-sm font-semibold text-zinc-100 pb-2 border-b border-zinc-800">5. Pengaturan Tampilan di Toko</h3>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-2">
                <label class="flex items-center gap-2 cursor-pointer text-xs text-zinc-300">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                           class="rounded bg-onyx-900 border-zinc-700 text-gold-500 focus:ring-0">
                    <span class="font-medium">Tampilkan (Aktif)</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer text-xs text-zinc-300">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                           class="rounded bg-onyx-900 border-zinc-700 text-gold-500 focus:ring-0">
                    <span>Produk Unggulan</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer text-xs text-zinc-300">
                    <input type="checkbox" name="is_bestseller" value="1" {{ old('is_bestseller', $product->is_bestseller) ? 'checked' : '' }}
                           class="rounded bg-onyx-900 border-zinc-700 text-gold-500 focus:ring-0">
                    <span>Tandai Bestseller</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer text-xs text-zinc-300">
                    <input type="checkbox" name="is_new" value="1" {{ old('is_new', $product->is_new) ? 'checked' : '' }}
                           class="rounded bg-onyx-900 border-zinc-700 text-gold-500 focus:ring-0">
                    <span>Koleksi Baru</span>
                </label>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-end gap-3 pt-3">
            <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 text-xs rounded-lg transition-colors border border-zinc-700 font-medium">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-gold-500 to-gold-400 hover:from-gold-400 hover:to-gold-300 text-onyx-900 font-semibold text-xs tracking-wider uppercase rounded-lg shadow-lg shadow-gold-500/10 transition-all">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

