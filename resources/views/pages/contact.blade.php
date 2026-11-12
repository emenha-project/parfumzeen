@extends('layouts.app')

@section('title', 'Butik & Kontak Concierge | ZEEN PARFUM')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <div class="border-b border-black pb-4 mb-12">
        <h1 class="font-serif-luxury text-3xl md:text-4xl font-bold tracking-tight text-black">
            KONSULTASI & BUTIK RESMI
        </h1>
        <p class="text-xs text-neutral-500 font-light mt-1">
            Hubungi fragrance advisor kami untuk rekomendasi aroma atau bantuan pesanan Anda.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
        <!-- Contact Information -->
        <div class="space-y-8">
            <div class="border border-neutral-200 p-8 bg-neutral-50/50 space-y-4">
                <span class="text-xs font-bold uppercase tracking-widest text-neutral-400">LAYANAN WHATSAPP CONCIERGE</span>
                <h3 class="font-serif-luxury text-xl font-bold text-black">KONSULTASI AROMA PERSONAL (1-ON-1)</h3>
                <p class="text-xs text-neutral-600 font-light leading-relaxed">
                    Bingung memilih aroma yang tepat untuk pesta malam, pertemuan bisnis, atau kado istimewa? Fragrance specialist kami siap mendengarkan preferensi Anda secara langsung via WhatsApp.
                </p>
                <div class="pt-2">
                    <a href="https://wa.me/6281234567890?text=Halo%20ZEEN%20PARFUM%2C%20saya%20ingin%20konsultasi%20pemilihan%20parfum" target="_blank"
                       class="inline-flex items-center space-x-2 bg-black text-white hover:bg-emerald-600 transition text-xs font-bold uppercase tracking-widest px-6 py-3.5">
                        <i class="fa-brands fa-whatsapp text-sm text-emerald-400"></i>
                        <span>CHAT FRAGRANCE SPECIALIST</span>
                    </a>
                </div>
            </div>

            <!-- Locations -->
            <div class="space-y-4 text-xs text-neutral-600">
                <div class="border border-neutral-200 p-6 space-y-2 bg-white">
                    <h4 class="font-bold text-sm text-black uppercase tracking-wider">ZEEN PARFUM FLAGSHIP ATELIER</h4>
                    <p class="font-light">Senopati Arcade Suites Lt. 2, Kebayoran Baru, Jakarta Selatan 12190</p>
                    <p class="text-neutral-400">Buka Setiap Hari: 10:00 - 21:00 WIB</p>
                </div>

                <div class="border border-neutral-200 p-6 space-y-2 bg-white">
                    <h4 class="font-bold text-sm text-black uppercase tracking-wider">CUSTOMER CARE & ORDER TRACKING</h4>
                    <p class="font-light">Email: concierge@zeenparfum.com</p>
                    <p class="font-light">Telepon: (021) 579-2889</p>
                    <p class="text-neutral-400">Senin - Sabtu: 09:00 - 18:00 WIB</p>
                </div>
            </div>
        </div>

        <!-- Quick Message Form -->
        <div class="border border-neutral-200 p-8 bg-white space-y-4">
            <h3 class="font-serif-luxury text-xl font-bold text-black border-b border-neutral-200 pb-3">
                KIRIM PESAN LANGSUNG
            </h3>
            <form onsubmit="event.preventDefault(); alert('Pesan Anda telah terkirim! Tim kami akan membalas via WhatsApp/Email dalam 1x24 jam.');" class="space-y-4 text-xs">
                <div>
                    <label class="block font-bold uppercase tracking-wider text-black mb-1">Nama Lengkap</label>
                    <input type="text" required placeholder="Nama Anda"
                           class="w-full bg-neutral-50 border border-neutral-300 p-3 focus:outline-none focus:border-black focus:bg-white">
                </div>
                <div>
                    <label class="block font-bold uppercase tracking-wider text-black mb-1">Nomor WhatsApp</label>
                    <input type="tel" required placeholder="081234567890"
                           class="w-full bg-neutral-50 border border-neutral-300 p-3 focus:outline-none focus:border-black focus:bg-white">
                </div>
                <div>
                    <label class="block font-bold uppercase tracking-wider text-black mb-1">Pesan / Pertanyaan</label>
                    <textarea rows="4" required placeholder="Tuliskan pertanyaan atau kebutuhan konsultasi Anda di sini..."
                              class="w-full bg-neutral-50 border border-neutral-300 p-3 focus:outline-none focus:border-black focus:bg-white"></textarea>
                </div>
                <button type="submit"
                        class="w-full bg-black text-white font-bold uppercase tracking-widest py-3.5 hover:bg-neutral-800 transition">
                    KIRIM PESAN
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

