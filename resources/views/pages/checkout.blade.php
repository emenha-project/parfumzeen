@extends('layouts.app')

@section('title', 'Checkout & Pembayaran | ZEEN PARFUM')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">
    <!-- Breadcrumb -->
    <nav class="text-[11px] text-neutral-400 uppercase tracking-wider mb-6 flex items-center space-x-2">
        <a href="{{ route('cart.index') }}" class="hover:text-black">Tas Belanja</a>
        <span>/</span>
        <span class="text-black font-semibold">Proses Checkout & Pembayaran</span>
    </nav>

    <div class="border-b border-black pb-4 mb-8">
        <h1 class="font-serif-luxury text-3xl md:text-4xl font-bold tracking-tight text-black">
            CHECKOUT RESMI ZEEN PARFUM
        </h1>
        <p class="text-xs text-neutral-500 font-light mt-1">
            Lengkapi data pengiriman dan pilih metode pembayaran resmi Anda.
        </p>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <!-- Left Form (7 Cols) -->
            <div class="lg:col-span-7 space-y-8">
                <!-- 1. Customer Contact Details -->
                <div class="border border-neutral-200 p-6 bg-white space-y-4">
                    <div class="flex items-center space-x-3 pb-3 border-b border-neutral-100">
                        <span class="w-6 h-6 rounded-full bg-black text-white text-xs font-bold flex items-center justify-center">1</span>
                        <h3 class="font-serif-luxury text-base font-bold text-black uppercase tracking-wider">INFORMASI PENERIMA</h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-black mb-1">Nama Lengkap *</label>
                            <input type="text" name="customer_name" required value="{{ old('customer_name') }}"
                                   placeholder="Contoh: Amanda Putri"
                                   class="w-full bg-neutral-50 border border-neutral-300 text-xs px-4 py-3 focus:outline-none focus:border-black focus:bg-white">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-black mb-1">Nomor WhatsApp / HP *</label>
                            <input type="tel" name="customer_phone" required value="{{ old('customer_phone') }}"
                                   placeholder="081234567890"
                                   class="w-full bg-neutral-50 border border-neutral-300 text-xs px-4 py-3 focus:outline-none focus:border-black focus:bg-white">
                            <span class="text-[10px] text-neutral-400">Konfirmasi resi akan dikirim via WhatsApp</span>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-black mb-1">Email Aktif *</label>
                            <input type="email" name="customer_email" required value="{{ old('customer_email') }}"
                                   placeholder="nama@email.com"
                                   class="w-full bg-neutral-50 border border-neutral-300 text-xs px-4 py-3 focus:outline-none focus:border-black focus:bg-white">
                        </div>
                    </div>
                </div>

                <!-- 2. Shipping Address -->
                <div class="border border-neutral-200 p-6 bg-white space-y-4">
                    <div class="flex items-center space-x-3 pb-3 border-b border-neutral-100">
                        <span class="w-6 h-6 rounded-full bg-black text-white text-xs font-bold flex items-center justify-center">2</span>
                        <h3 class="font-serif-luxury text-base font-bold text-black uppercase tracking-wider">ALAMAT LENGKAP PENGIRIMAN</h3>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-black mb-1">Alamat Lengkap & Patokan Rumah *</label>
                            <textarea name="customer_address" required rows="2"
                                      placeholder="Jl. Senopati No. 88, RT 01 / RW 02, Kebayoran Baru"
                                      class="w-full bg-neutral-50 border border-neutral-300 text-xs px-4 py-3 focus:outline-none focus:border-black focus:bg-white">{{ old('customer_address') }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-black mb-1">Kota / Kabupaten *</label>
                                <input type="text" name="customer_city" required value="{{ old('customer_city', 'Jakarta Selatan') }}"
                                       placeholder="Jakarta Selatan"
                                       class="w-full bg-neutral-50 border border-neutral-300 text-xs px-4 py-3 focus:outline-none focus:border-black focus:bg-white">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-black mb-1">Provinsi</label>
                                <input type="text" name="customer_province" value="{{ old('customer_province', 'DKI Jakarta') }}"
                                       placeholder="DKI Jakarta"
                                       class="w-full bg-neutral-50 border border-neutral-300 text-xs px-4 py-3 focus:outline-none focus:border-black focus:bg-white">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-black mb-1">Kode Pos</label>
                                <input type="text" name="customer_postal_code" value="{{ old('customer_postal_code', '12190') }}"
                                       placeholder="12190"
                                       class="w-full bg-neutral-50 border border-neutral-300 text-xs px-4 py-3 focus:outline-none focus:border-black focus:bg-white">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-black mb-1">Catatan Tambahan untuk Kurir (Opsional)</label>
                            <input type="text" name="customer_notes" value="{{ old('customer_notes') }}"
                                   placeholder="Tolong titip ke security atau ketuk pagar warna hitam"
                                   class="w-full bg-neutral-50 border border-neutral-300 text-xs px-4 py-2.5 focus:outline-none focus:border-black focus:bg-white">
                        </div>
                    </div>
                </div>

                <!-- 3. Payment Method Selection (QRIS & Bank Transfer) -->
                <div class="border border-neutral-200 p-6 bg-white space-y-4">
                    <div class="flex items-center space-x-3 pb-3 border-b border-neutral-100">
                        <span class="w-6 h-6 rounded-full bg-black text-white text-xs font-bold flex items-center justify-center">3</span>
                        <h3 class="font-serif-luxury text-base font-bold text-black uppercase tracking-wider">PILIH METODE PEMBAYARAN</h3>
                    </div>

                    <div class="space-y-3">
                        <!-- Option 1: QRIS INSTAN (Recommended) -->
                        <label class="flex items-start p-4 border border-black bg-neutral-50/50 cursor-pointer rounded transition">
                            <input type="radio" name="payment_method" value="qris" checked class="mt-1 text-black focus:ring-black">
                            <div class="ml-3 flex-1">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <span class="font-bold text-xs uppercase tracking-wider text-black">QRIS INSTAN (SEMUA E-WALLET & MOBILE BANKING)</span>
                                        <span class="bg-black text-white text-[9px] font-bold px-2 py-0.5 rounded">TERCEPAT</span>
                                    </div>
                                    <i class="fa-solid fa-qrcode text-lg text-black"></i>
                                </div>
                                <p class="text-[11px] text-neutral-500 mt-1">
                                    Scan QR langsung menggunakan GoPay, OVO, Dana, ShopeePay, LinkAja, BCA Mobile, Livin Mandiri, BRImo, dll. Konfirmasi otomatis seketika.
                                </p>
                            </div>
                        </label>

                        <!-- Option 2: BCA Virtual Account -->
                        <label class="flex items-start p-4 border border-neutral-200 hover:border-black cursor-pointer rounded transition bg-white">
                            <input type="radio" name="payment_method" value="bca_va" class="mt-1 text-black focus:ring-black">
                            <div class="ml-3 flex-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-xs uppercase tracking-wider text-black">BCA VIRTUAL ACCOUNT</span>
                                    <span class="text-xs font-bold text-blue-800">BCA</span>
                                </div>
                                <p class="text-[11px] text-neutral-500 mt-1">
                                    Nomor Virtual Account khusus pesanan Anda. Bayar via BCA Mobile, KlikBCA, atau ATM BCA.
                                </p>
                            </div>
                        </label>

                        <!-- Option 3: Mandiri Virtual Account -->
                        <label class="flex items-start p-4 border border-neutral-200 hover:border-black cursor-pointer rounded transition bg-white">
                            <input type="radio" name="payment_method" value="mandiri_va" class="mt-1 text-black focus:ring-black">
                            <div class="ml-3 flex-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-xs uppercase tracking-wider text-black">MANDIRI VIRTUAL ACCOUNT</span>
                                    <span class="text-xs font-bold text-amber-700">MANDIRI</span>
                                </div>
                                <p class="text-[11px] text-neutral-500 mt-1">
                                    Bayar mudah via Livin' by Mandiri, ATM Mandiri, atau Internet Banking.
                                </p>
                            </div>
                        </label>

                        <!-- Option 4: BNI Virtual Account -->
                        <label class="flex items-start p-4 border border-neutral-200 hover:border-black cursor-pointer rounded transition bg-white">
                            <input type="radio" name="payment_method" value="bni_va" class="mt-1 text-black focus:ring-black">
                            <div class="ml-3 flex-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-xs uppercase tracking-wider text-black">BNI VIRTUAL ACCOUNT</span>
                                    <span class="text-xs font-bold text-teal-700">BNI</span>
                                </div>
                                <p class="text-[11px] text-neutral-500 mt-1">
                                    Transfer instan via BNI Mobile Banking, Internet Banking, atau ATM BNI.
                                </p>
                            </div>
                        </label>

                        <!-- Option 5: BRI Virtual Account -->
                        <label class="flex items-start p-4 border border-neutral-200 hover:border-black cursor-pointer rounded transition bg-white">
                            <input type="radio" name="payment_method" value="bri_va" class="mt-1 text-black focus:ring-black">
                            <div class="ml-3 flex-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-xs uppercase tracking-wider text-black">BRI VIRTUAL ACCOUNT (BRIVA)</span>
                                    <span class="text-xs font-bold text-blue-700">BRI</span>
                                </div>
                                <p class="text-[11px] text-neutral-500 mt-1">
                                    Bayar melalui aplikasi BRImo, Internet Banking, atau ATM BRI.
                                </p>
                            </div>
                        </label>

                        <!-- Option 6: Bank Transfer Manual -->
                        <label class="flex items-start p-4 border border-neutral-200 hover:border-black cursor-pointer rounded transition bg-white">
                            <input type="radio" name="payment_method" value="bank_transfer" class="mt-1 text-black focus:ring-black">
                            <div class="ml-3 flex-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-xs uppercase tracking-wider text-black">TRANSFER MANUAL KE REKENING RESMI</span>
                                    <i class="fa-solid fa-building-columns text-sm text-neutral-500"></i>
                                </div>
                                <p class="text-[11px] text-neutral-500 mt-1">
                                    Transfer ke rekening PT / Rekening Resmi ZEEN PARFUM dengan upload bukti transfer.
                                </p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Right: Order Summary Sidebar (5 Cols) -->
            <div class="lg:col-span-5 bg-neutral-50 border border-neutral-200 p-6 space-y-6 lg:sticky lg:top-28">
                <h3 class="font-serif-luxury text-lg font-bold text-black border-b border-neutral-200 pb-3">
                    RINGKASAN PESANAN
                </h3>

                <!-- Items Preview -->
                <div class="space-y-3 max-h-60 overflow-y-auto pr-1 divide-y divide-neutral-200">
                    @foreach($cart as $item)
                        <div class="flex items-center space-x-3 pt-3 first:pt-0">
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                                 class="w-12 h-16 object-cover bg-neutral-100 flex-shrink-0 border border-neutral-200">
                            <div class="flex-1 min-w-0">
                                <h4 class="font-serif-luxury font-bold text-xs truncate text-black">{{ $item['name'] }}</h4>
                                <div class="text-[10px] text-neutral-500">{{ $item['concentration'] }} • {{ $item['size'] }}</div>
                                <div class="text-[11px] text-neutral-600">Qty: {{ $item['quantity'] }}</div>
                            </div>
                            <div class="text-xs font-bold text-black font-sans">
                                Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Price Breakdown -->
                <div class="space-y-2.5 text-xs text-neutral-600 border-t border-neutral-200 pt-4">
                    <div class="flex justify-between">
                        <span>Subtotal Produk</span>
                        <span class="font-bold text-black">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span>Ongkos Kirim Express</span>
                        <span class="font-bold text-black">
                            @if($shippingFee == 0)
                                <span class="text-emerald-700 uppercase font-bold">GRATIS</span>
                            @else
                                Rp {{ number_format($shippingFee, 0, ',', '.') }}
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between text-neutral-500 text-[11px]">
                        <span>Gratis 2 Sampel Discovery Vial</span>
                        <span class="text-emerald-700 font-bold uppercase">TERMASUK</span>
                    </div>
                </div>

                <!-- Grand Total -->
                <div class="border-t border-neutral-200 pt-4 flex justify-between items-baseline">
                    <div>
                        <span class="font-bold text-sm text-black">TOTAL YANG HARUS DIBAYAR</span>
                        <div class="text-[10px] text-neutral-400">Termasuk pajak & kemasan aman</div>
                    </div>
                    <span class="font-sans font-bold text-2xl text-black">
                        Rp {{ number_format($grandTotal, 0, ',', '.') }}
                    </span>
                </div>

                <!-- Submit Button -->
                <div class="pt-2 space-y-3">
                    <button type="submit"
                            class="w-full bg-black hover:bg-neutral-800 text-white text-xs font-bold uppercase tracking-widest py-4 flex items-center justify-center space-x-2 transition shadow-lg">
                        <i class="fa-solid fa-lock text-xs"></i>
                        <span>PROSES PESANAN & BAYAR</span>
                    </button>

                    <div class="text-[11px] text-neutral-500 text-center leading-relaxed">
                        Dengan menekan tombol di atas, Anda menyetujui syarat & ketentuan pemesanan ZEEN PARFUM Indonesia.
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
