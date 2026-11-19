@extends('layouts.app')

@section('title', 'Lacak Pesanan — ZEEN Atelier')

@section('content')
{{-- Hero --}}
<section class="bg-black text-white py-16 px-4 text-center">
    <p class="text-xs tracking-[0.3em] text-amber-400 uppercase mb-3">ZEEN Atelier</p>
    <h1 class="text-3xl md:text-4xl font-light tracking-widest uppercase mb-3">Lacak Pesanan</h1>
    <p class="text-gray-400 text-sm tracking-wide">Pantau status pengiriman paket Anda secara real-time</p>
</section>

{{-- Error / Info --}}
@if(session('error'))
<div class="max-w-lg mx-auto mt-6 px-4">
    <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg p-4 text-sm flex items-center gap-3">
        <span class="text-xl">⚠️</span>
        <span>{{ session('error') }}</span>
    </div>
</div>
@endif

{{-- Tracking Search Form --}}
<section class="max-w-lg mx-auto px-4 py-12">
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-black rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-2xl">📦</span>
            </div>
            <h2 class="text-xl font-semibold text-gray-900 mb-2">Lacak Paket Anda</h2>
            <p class="text-gray-500 text-sm">Masukkan nomor pesanan dan nomor HP / email yang terdaftar</p>
        </div>

        <form action="" method="GET" id="trackingForm">
            {{-- Order Number --}}
            <div class="mb-5">
                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-widest mb-2">
                    Nomor Pesanan <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="order_number"
                    id="orderNumberInput"
                    placeholder="Contoh: ZN-20261119-XXXXX"
                    value="{{ old('order_number', request('order_number')) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-black focus:ring-1 focus:ring-black font-mono"
                    required
                />
                <p class="text-xs text-gray-400 mt-1">Nomor pesanan ada di email konfirmasi atau invoice Anda</p>
            </div>

            {{-- Phone --}}
            <div class="mb-5">
                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-widest mb-2">
                    Nomor HP / Email (Verifikasi)
                </label>
                <input
                    type="text"
                    name="phone"
                    placeholder="Contoh: 08123456789 atau nama@email.com"
                    value="{{ old('phone', request('phone')) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-black focus:ring-1 focus:ring-black"
                />
                <p class="text-xs text-gray-400 mt-1">Opsional — untuk verifikasi kepemilikan pesanan</p>
            </div>

            <button type="submit" id="trackBtn"
                class="w-full bg-black text-white py-3.5 rounded-lg text-sm font-semibold tracking-widest uppercase hover:bg-gray-800 transition-colors">
                🔍 Lacak Sekarang
            </button>
        </form>
    </div>

    {{-- Tips --}}
    <div class="mt-8 bg-amber-50 border border-amber-200 rounded-xl p-5">
        <p class="text-xs font-semibold text-amber-800 uppercase tracking-widest mb-3">💡 Tips Tracking</p>
        <ul class="text-sm text-amber-700 space-y-2">
            <li>• Nomor pesanan dikirim ke email Anda saat checkout berhasil</li>
            <li>• Status diperbarui oleh tim ZEEN setiap ada perubahan pengiriman</li>
            <li>• Hubungi CS via WhatsApp jika ada kendala: <a href="https://wa.me/6281234567890" class="underline font-semibold">+62 812-3456-7890</a></li>
        </ul>
    </div>
</section>

<script>
document.getElementById('trackingForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const orderNum = document.getElementById('orderNumberInput').value.trim();
    if (!orderNum) return;
    const phone = this.querySelector('[name=phone]').value.trim();
    let url = '/tracking/' + encodeURIComponent(orderNum);
    if (phone) url += '?phone=' + encodeURIComponent(phone);
    window.location.href = url;
});
</script>
@endsection
