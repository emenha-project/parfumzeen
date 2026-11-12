<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVOICE #{{ $order->order_number }} - ZEEN PARFUM</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-serif-luxury { font-family: 'Playfair Display', serif; }
        @media print {
            .no-print { display: none !important; }
        }
    </style>
</head>
<body class="bg-neutral-100 text-black py-10">
    <div class="max-w-3xl mx-auto bg-white p-8 md:p-12 shadow-sm border border-neutral-300">
        <!-- Actions (Print) -->
        <div class="no-print flex justify-between items-center pb-6 mb-6 border-b border-neutral-200 text-xs">
            <a href="{{ route('payment.show', $order->order_number) }}" class="text-neutral-500 hover:text-black font-semibold">
                &larr; Kembali ke Rincian Pesanan
            </a>
            <button onclick="window.print()" class="bg-black text-white px-5 py-2 uppercase font-bold tracking-wider hover:bg-neutral-800">
                Cetak / Simpan PDF
            </button>
        </div>

        <!-- Header -->
        <div class="flex justify-between items-start border-b border-black pb-8">
            <div>
                <h1 class="font-serif-luxury text-3xl font-bold tracking-widest">ZEEN PARFUM</h1>
                <p class="text-[10px] uppercase tracking-[0.3em] text-neutral-500 font-semibold mt-1">HAUTE PARFUMERIE</p>
                <p class="text-xs text-neutral-500 mt-2">
                    Jakarta Selatan, DKI Jakarta 12190<br>
                    support@zeenparfum.com | +62 812-3456-7890
                </p>
            </div>
            <div class="text-right">
                <span class="text-xs font-bold uppercase tracking-widest text-neutral-400">FAKTUR PESANAN</span>
                <div class="font-mono text-base font-bold text-black mt-1">#{{ $order->order_number }}</div>
                <div class="text-xs text-neutral-500 mt-1">Tanggal: {{ $order->created_at->format('d/m/Y') }}</div>
                <div class="mt-2">
                    @if($order->payment_status === 'paid')
                        <span class="inline-block bg-emerald-100 text-emerald-800 border border-emerald-300 text-[10px] font-bold px-3 py-1 uppercase tracking-wider rounded">
                            LUNAS / DIBAYAR
                        </span>
                    @else
                        <span class="inline-block bg-yellow-100 text-yellow-800 border border-yellow-300 text-[10px] font-bold px-3 py-1 uppercase tracking-wider rounded">
                            BELUM LUNAS
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Customer & Shipping -->
        <div class="grid grid-cols-2 gap-8 py-6 text-xs border-b border-neutral-200">
            <div>
                <span class="text-[10px] uppercase tracking-wider text-neutral-400 font-bold block mb-1">DITUJUKAN KEPADA:</span>
                <div class="font-bold text-sm text-black">{{ $order->customer_name }}</div>
                <div class="text-neutral-600 mt-1">{{ $order->customer_phone }} | {{ $order->customer_email }}</div>
            </div>
            <div>
                <span class="text-[10px] uppercase tracking-wider text-neutral-400 font-bold block mb-1">ALAMAT PENGIRIMAN:</span>
                <div class="text-neutral-700 leading-relaxed">
                    {{ $order->customer_address }}<br>
                    {{ $order->customer_city }}, {{ $order->customer_province }} {{ $order->customer_postal_code }}
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <div class="py-6 border-b border-neutral-200">
            <table class="w-full text-xs text-left">
                <thead>
                    <tr class="border-b border-black text-[10px] uppercase tracking-wider font-bold">
                        <th class="py-2">Item Deskripsi</th>
                        <th class="py-2 text-center">Ukuran</th>
                        <th class="py-2 text-center">Qty</th>
                        <th class="py-2 text-right">Harga Satuan</th>
                        <th class="py-2 text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @foreach($order->items as $item)
                        <tr>
                            <td class="py-3 font-semibold">{{ $item->product_name }}</td>
                            <td class="py-3 text-center text-neutral-600">{{ $item->size }}</td>
                            <td class="py-3 text-center">{{ $item->quantity }}</td>
                            <td class="py-3 text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="py-3 text-right font-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Totals -->
        <div class="pt-6 flex justify-end text-xs">
            <div class="w-64 space-y-2">
                <div class="flex justify-between text-neutral-600">
                    <span>Subtotal:</span>
                    <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-neutral-600">
                    <span>Ongkos Kirim:</span>
                    <span>{{ $order->shipping_fee == 0 ? 'GRATIS' : 'Rp ' . number_format($order->shipping_fee, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between font-bold text-sm text-black border-t border-black pt-2">
                    <span>TOTAL:</span>
                    <span>{{ $order->formatted_total }}</span>
                </div>
                <div class="text-[10px] text-neutral-400 text-right pt-1">
                    Metode: {{ $order->payment_method_label }}
                </div>
            </div>
        </div>

        <!-- Footer Note -->
        <div class="mt-12 pt-6 border-t border-neutral-200 text-center text-[10px] text-neutral-400">
            Terima kasih telah mempercayakan wewangian Anda kepada ZEEN PARFUM.<br>
            Untuk pertanyaan atau klaim garansi, hubungi WhatsApp Concierge resmi kami.
        </div>
    </div>
</body>
</html>
