@extends('layouts.app')

@section('title', 'Pembayaran Pesanan #' . $order->order_number . ' | ZEEN PARFUM')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
    <!-- Payment Status Notification Header -->
    <div class="text-center mb-8">
        @if($order->payment_status === 'paid')
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 mb-4">
                <i class="fa-solid fa-check text-2xl"></i>
            </div>
            <span class="text-emerald-700 text-xs font-bold uppercase tracking-[0.25em] block mb-1">TRANSAKSI BERHASIL</span>
            <h1 class="font-serif-luxury text-3xl md:text-4xl font-bold text-black">
                PEMBAYARAN TELAH KAMI TERIMA
            </h1>
            <p class="text-xs text-neutral-500 mt-2 max-w-md mx-auto">
                Terima kasih atas pesanan Anda. Tim atelier kami sedang meracik dan mengemas wewangian Anda dengan standar kemasan eksklusif ZEEN.
            </p>
        @else
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-neutral-100 text-black mb-3">
                <i class="fa-solid fa-clock-rotate-left text-xl"></i>
            </div>
            <span class="text-neutral-500 text-[10px] font-bold uppercase tracking-[0.25em] block mb-1">MENUNGGU PEMBAYARAN</span>
            <h1 class="font-serif-luxury text-2xl md:text-3xl font-bold text-black">
                SELESAIKAN PEMBAYARAN ANDA
            </h1>
            <p class="text-xs text-neutral-500 mt-1">
                Nomor Pesanan: <strong class="text-black font-mono">{{ $order->order_number }}</strong>
            </p>
        @endif
    </div>

    <!-- Main Payment Container Card -->
    <div class="border border-neutral-200 bg-white shadow-sm overflow-hidden">
        <!-- Top Bar: Total Amount & Status -->
        <div class="bg-black text-white p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                <span class="text-[10px] uppercase tracking-widest text-neutral-400 block">TOTAL TAGIHAN</span>
                <span class="font-sans font-bold text-2xl md:text-3xl text-white">
                    {{ $order->formatted_total }}
                </span>
            </div>
            <div class="text-center sm:text-right">
                <span class="text-[10px] uppercase tracking-widest text-neutral-400 block mb-1">STATUS PESANAN</span>
                @if($order->payment_status === 'paid')
                    <span class="bg-emerald-600 text-white text-xs font-bold uppercase px-3 py-1 rounded">
                        LUNAS / SUDAH DIBAYAR
                    </span>
                @elseif($order->payment_status === 'reviewing')
                    <span class="bg-amber-600 text-white text-xs font-bold uppercase px-3 py-1 rounded">
                        MENUNGGU VERIFIKASI BUKTI
                    </span>
                @else
                    <span class="bg-yellow-500 text-black text-xs font-bold uppercase px-3 py-1 rounded">
                        MENUNGGU PEMBAYARAN
                    </span>
                @endif
            </div>
        </div>

        @if($order->payment_status !== 'paid')
            <!-- PAYMENT INSTRUCTIONS ACCORDING TO METHOD -->
            <div class="p-6 md:p-10">
                @if($order->payment_method === 'qris')
                    <!-- 1. QRIS CODE INTERFACE -->
                    <div class="max-w-md mx-auto text-center space-y-6">
                        <!-- Countdown Timer -->
                        <div class="inline-flex items-center space-x-2 bg-neutral-100 px-4 py-2 rounded-full text-xs font-semibold text-neutral-700">
                            <i class="fa-regular fa-clock text-black"></i>
                            <span>Sisa Waktu Pembayaran: <strong id="countdown" class="text-red-600 font-mono">14:59</strong></span>
                        </div>

                        <!-- QR Code Illustration Canvas / SVG -->
                        <div class="p-6 bg-white border-2 border-black inline-block shadow-lg relative group">
                            <!-- Header QRIS Brand -->
                            <div class="flex items-center justify-between pb-3 mb-3 border-b border-neutral-200">
                                <span class="font-serif-luxury font-bold text-sm tracking-widest text-black">ZEEN PARFUM</span>
                                <span class="text-[10px] bg-red-600 text-white font-bold px-1.5 py-0.5 rounded uppercase">QRIS</span>
                            </div>

                            <!-- Vector QR Code representation -->
                            <div class="w-64 h-64 bg-white flex items-center justify-center relative p-2">
                                <svg class="w-full h-full" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <!-- QR Code Pattern Elements -->
                                    <rect width="200" height="200" fill="white"/>
                                    <!-- Top-Left Corner -->
                                    <rect x="10" y="10" width="50" height="50" rx="4" fill="black"/>
                                    <rect x="20" y="20" width="30" height="30" fill="white"/>
                                    <rect x="26" y="26" width="18" height="18" fill="black"/>

                                    <!-- Top-Right Corner -->
                                    <rect x="140" y="10" width="50" height="50" rx="4" fill="black"/>
                                    <rect x="150" y="20" width="30" height="30" fill="white"/>
                                    <rect x="156" y="26" width="18" height="18" fill="black"/>

                                    <!-- Bottom-Left Corner -->
                                    <rect x="10" y="140" width="50" height="50" rx="4" fill="black"/>
                                    <rect x="20" y="150" width="30" height="30" fill="white"/>
                                    <rect x="26" y="156" width="18" height="18" fill="black"/>

                                    <!-- Center Grid Mock Data Matrix -->
                                    <rect x="70" y="15" width="10" height="10" fill="black"/>
                                    <rect x="90" y="15" width="15" height="10" fill="black"/>
                                    <rect x="115" y="15" width="10" height="10" fill="black"/>
                                    
                                    <rect x="70" y="35" width="20" height="10" fill="black"/>
                                    <rect x="100" y="35" width="10" height="20" fill="black"/>
                                    <rect x="120" y="35" width="10" height="10" fill="black"/>

                                    <rect x="15" y="70" width="10" height="20" fill="black"/>
                                    <rect x="35" y="70" width="15" height="10" fill="black"/>
                                    <rect x="60" y="70" width="25" height="10" fill="black"/>
                                    <rect x="95" y="65" width="20" height="20" fill="black"/>
                                    <rect x="125" y="70" width="20" height="10" fill="black"/>
                                    <rect x="155" y="70" width="30" height="10" fill="black"/>

                                    <rect x="25" y="100" width="10" height="25" fill="black"/>
                                    <rect x="45" y="95" width="15" height="10" fill="black"/>
                                    <rect x="70" y="100" width="10" height="10" fill="black"/>
                                    <rect x="90" y="95" width="30" height="10" fill="black"/>
                                    <rect x="130" y="100" width="25" height="10" fill="black"/>
                                    <rect x="165" y="95" width="15" height="20" fill="black"/>

                                    <rect x="70" y="125" width="20" height="10" fill="black"/>
                                    <rect x="100" y="120" width="15" height="25" fill="black"/>
                                    <rect x="125" y="125" width="10" height="10" fill="black"/>
                                    <rect x="145" y="120" width="20" height="10" fill="black"/>

                                    <rect x="70" y="155" width="15" height="15" fill="black"/>
                                    <rect x="95" y="160" width="20" height="10" fill="black"/>
                                    <rect x="125" y="150" width="15" height="20" fill="black"/>
                                    <rect x="150" y="155" width="35" height="10" fill="black"/>
                                    <rect x="145" y="175" width="20" height="15" fill="black"/>

                                    <!-- Center Mini Logo Badge -->
                                    <circle cx="100" cy="100" r="16" fill="white" stroke="black" stroke-width="2"/>
                                    <text x="100" y="104" font-family="serif" font-size="10" font-weight="bold" text-anchor="middle" fill="black">Z</text>
                                </svg>
                            </div>

                            <!-- Footer note -->
                            <div class="pt-3 mt-3 border-t border-neutral-200 text-[10px] text-neutral-500 flex justify-between items-center">
                                <span>NMID: ID102030495810</span>
                                <span>A.N ZEEN PARFUM</span>
                            </div>
                        </div>

                        <!-- Supported E-Wallets & Mobile Banking Icons -->
                        <div class="space-y-2">
                            <span class="text-[10px] uppercase tracking-wider text-neutral-400 font-bold block">
                                DAPAT DI-SCAN DENGAN SEMUA APLIKASI BERIKUT:
                            </span>
                            <div class="flex flex-wrap justify-center items-center gap-2 text-xs font-bold text-neutral-700">
                                <span class="bg-neutral-100 px-3 py-1 rounded border">GoPay</span>
                                <span class="bg-neutral-100 px-3 py-1 rounded border">OVO</span>
                                <span class="bg-neutral-100 px-3 py-1 rounded border">ShopeePay</span>
                                <span class="bg-neutral-100 px-3 py-1 rounded border">DANA</span>
                                <span class="bg-neutral-100 px-3 py-1 rounded border">BCA Mobile</span>
                                <span class="bg-neutral-100 px-3 py-1 rounded border">Livin Mandiri</span>
                                <span class="bg-neutral-100 px-3 py-1 rounded border">BRImo</span>
                            </div>
                        </div>

                        <!-- DEMO SIMULATOR BUTTON (Instant Payment Simulation for Test) -->
                        <div class="pt-4 border-t border-neutral-200 space-y-2">
                            <form action="{{ route('payment.simulate', $order->order_number) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold uppercase tracking-widest py-3.5 flex items-center justify-center space-x-2 transition shadow">
                                    <i class="fa-solid fa-circle-check text-sm"></i>
                                    <span>SIMULASI BAYAR SEKARANG (TEST DEMO)</span>
                                </button>
                            </form>
                            <p class="text-[10px] text-neutral-400">
                                Klik tombol di atas untuk mensimulasikan pembayaran berhasil secara instan.
                            </p>
                        </div>
                    </div>
                @else
                    <!-- 2. BANK TRANSFER / VIRTUAL ACCOUNT INTERFACE -->
                    <div class="max-w-lg mx-auto space-y-6">
                        <!-- Account Details Box -->
                        <div class="bg-neutral-50 border border-neutral-200 p-6 space-y-4">
                            <div class="flex items-center justify-between border-b border-neutral-200 pb-3">
                                <div>
                                    <span class="text-[10px] uppercase tracking-wider text-neutral-400 font-bold">NAMA BANK</span>
                                    <h4 class="font-serif-luxury font-bold text-lg text-black">{{ $currentBank['bank'] }}</h4>
                                </div>
                                <span class="text-xs bg-black text-white px-3 py-1 rounded font-bold uppercase">
                                    {{ $currentBank['type'] }}
                                </span>
                            </div>

                            <!-- Account Number with 1-Click Copy -->
                            <div>
                                <span class="text-[10px] uppercase tracking-wider text-neutral-400 font-bold block mb-1">
                                    NOMOR REKENING / VIRTUAL ACCOUNT
                                </span>
                                <div class="flex items-center justify-between bg-white border border-neutral-300 p-3">
                                    <span id="va-number" class="font-mono text-base font-bold text-black tracking-wider">
                                        {{ $currentBank['account_number'] }}
                                    </span>
                                    <button onclick="copyToClipboard('{{ $currentBank['account_number'] }}', this)"
                                            class="text-xs bg-neutral-900 text-white px-3 py-1.5 font-bold uppercase hover:bg-black transition">
                                        SALIN
                                    </button>
                                </div>
                            </div>

                            <!-- Account Holder Name -->
                            <div>
                                <span class="text-[10px] uppercase tracking-wider text-neutral-400 font-bold block mb-1">
                                    ATAS NAMA PENERIMA
                                </span>
                                <div class="font-bold text-xs text-black">{{ $currentBank['account_name'] }}</div>
                            </div>

                            <!-- Exact Nominal with Copy -->
                            <div class="border-t border-neutral-200 pt-3">
                                <span class="text-[10px] uppercase tracking-wider text-neutral-400 font-bold block mb-1">
                                    NOMINAL TRANSFER TEPAT
                                </span>
                                <div class="flex items-center justify-between bg-white border border-neutral-300 p-3">
                                    <span class="font-mono text-base font-bold text-black">
                                        {{ $order->formatted_total }}
                                    </span>
                                    <button onclick="copyToClipboard('{{ (int)$order->grand_total }}', this)"
                                            class="text-xs bg-neutral-900 text-white px-3 py-1.5 font-bold uppercase hover:bg-black transition">
                                        SALIN JUMLAH
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Proof of Payment (if Manual Transfer) -->
                        <div class="border border-neutral-200 p-6 bg-white space-y-3">
                            <h4 class="font-bold text-xs uppercase tracking-wider text-black">
                                UPLOAD BUKTI TRANSFER (OPSIONAL)
                            </h4>
                            <form action="{{ route('payment.proof', $order->order_number) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                @csrf
                                <input type="file" name="proof" required accept="image/*"
                                       class="w-full text-xs text-neutral-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-xs file:font-semibold file:bg-neutral-100 file:text-black hover:file:bg-neutral-200 cursor-pointer">
                                <button type="submit" class="w-full bg-black text-white text-xs font-bold uppercase tracking-wider py-2.5 hover:bg-neutral-800 transition">
                                    KIRIM BUKTI PEMBAYARAN
                                </button>
                            </form>
                        </div>

                        <!-- DEMO SIMULATOR BUTTON (Instant Payment Simulation for Test) -->
                        <div class="pt-4 border-t border-neutral-200 space-y-2">
                            <form action="{{ route('payment.simulate', $order->order_number) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold uppercase tracking-widest py-3.5 flex items-center justify-center space-x-2 transition shadow">
                                    <i class="fa-solid fa-circle-check text-sm"></i>
                                    <span>SIMULASI BAYAR SEKARANG (TEST DEMO)</span>
                                </button>
                            </form>
                            <p class="text-[10px] text-neutral-400 text-center">
                                Klik tombol di atas untuk mensimulasikan transfer bank berhasil secara instan.
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        @else
            <!-- ORDER PAID SUCCESS SCREEN -->
            <div class="p-8 md:p-12 text-center space-y-6">
                <div class="bg-neutral-50 border border-neutral-200 p-6 max-w-lg mx-auto text-left space-y-3 text-xs">
                    <div class="flex justify-between border-b border-neutral-200 pb-2">
                        <span class="text-neutral-500">Nomor Pesanan</span>
                        <span class="font-bold font-mono text-black">{{ $order->order_number }}</span>
                    </div>
                    <div class="flex justify-between border-b border-neutral-200 pb-2">
                        <span class="text-neutral-500">Waktu Pembayaran</span>
                        <span class="font-bold text-black">{{ $order->paid_at ? $order->paid_at->format('d M Y H:i') : now()->format('d M Y H:i') }} WIB</span>
                    </div>
                    <div class="flex justify-between border-b border-neutral-200 pb-2">
                        <span class="text-neutral-500">Metode Pembayaran</span>
                        <span class="font-bold text-black">{{ $order->payment_method_label }}</span>
                    </div>
                    <div class="flex justify-between border-b border-neutral-200 pb-2">
                        <span class="text-neutral-500">Penerima</span>
                        <span class="font-bold text-black">{{ $order->customer_name }} ({{ $order->customer_phone }})</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-neutral-500">Alamat Kirim</span>
                        <span class="font-bold text-black text-right max-w-xs">{{ $order->customer_address }}, {{ $order->customer_city }}</span>
                    </div>
                </div>

                <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
                    <a href="{{ route('order.invoice', $order->order_number) }}" target="_blank"
                       class="bg-black text-white text-xs font-bold uppercase tracking-widest px-8 py-3.5 hover:bg-neutral-800 transition flex items-center space-x-2">
                        <i class="fa-solid fa-receipt text-xs"></i>
                        <span>CETAK / LIHAT INVOICE</span>
                    </a>
                    <a href="{{ route('products.index') }}"
                       class="bg-white border border-neutral-300 text-black text-xs font-bold uppercase tracking-widest px-8 py-3.5 hover:bg-neutral-100 transition">
                        KEMBALI KE BUTIK
                    </a>
                </div>
            </div>
        @endif

        <!-- ORDER ITEMS RECAP -->
        <div class="border-t border-neutral-200 bg-neutral-50 p-6 md:p-8">
            <h4 class="font-serif-luxury text-sm font-bold text-black uppercase tracking-wider mb-4">
                ITEM DALAM PESANAN INI ({{ $order->items->count() }})
            </h4>
            <div class="divide-y divide-neutral-200">
                @foreach($order->items as $item)
                    <div class="py-3 flex items-center justify-between text-xs">
                        <div class="flex items-center space-x-3">
                            @if($item->image)
                                <img src="{{ $item->image }}" alt="{{ $item->product_name }}" class="w-10 h-12 object-cover border border-neutral-200 bg-white">
                            @endif
                            <div>
                                <span class="font-bold text-black">{{ $item->product_name }}</span>
                                <div class="text-[10px] text-neutral-500">{{ $item->size }} • Qty: {{ $item->quantity }}</div>
                            </div>
                        </div>
                        <span class="font-bold font-sans text-black">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function copyToClipboard(text, btn) {
        navigator.clipboard.writeText(text).then(() => {
            const originalText = btn.textContent;
            btn.textContent = 'TERSALIN!';
            btn.classList.add('bg-emerald-600');
            setTimeout(() => {
                btn.textContent = originalText;
                btn.classList.remove('bg-emerald-600');
            }, 2000);
        });
    }

    // 15-Minute Countdown timer simulation
    let seconds = 15 * 60;
    const countdownEl = document.getElementById('countdown');
    if (countdownEl) {
        const timer = setInterval(() => {
            seconds--;
            if (seconds <= 0) {
                clearInterval(timer);
                countdownEl.textContent = 'KEDALUWARSA';
            } else {
                const m = Math.floor(seconds / 60);
                const s = seconds % 60;
                countdownEl.textContent = `${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
            }
        }, 1000);
    }
</script>
@endpush
@endsection

