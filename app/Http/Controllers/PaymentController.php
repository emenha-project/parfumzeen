<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show(string $order_number)
    {
        $order = Order::with('items')->where('order_number', $order_number)->firstOrFail();

        // Bank Accounts data
        $bankDetails = [
            'bca_va' => [
                'bank' => 'BCA',
                'account_number' => '82719' . substr(preg_replace('/\D/', '', $order->customer_phone), -6),
                'account_name' => 'ZEEN PARFUM / ' . $order->customer_name,
                'type' => 'Virtual Account',
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg',
            ],
            'mandiri_va' => [
                'bank' => 'Mandiri',
                'account_number' => '89898' . substr(preg_replace('/\D/', '', $order->customer_phone), -6),
                'account_name' => 'ZEEN PARFUM / ' . $order->customer_name,
                'type' => 'Virtual Account',
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg',
            ],
            'bni_va' => [
                'bank' => 'BNI',
                'account_number' => '98801' . substr(preg_replace('/\D/', '', $order->customer_phone), -6),
                'account_name' => 'ZEEN PARFUM / ' . $order->customer_name,
                'type' => 'Virtual Account',
                'logo' => 'https://upload.wikimedia.org/wikipedia/id/5/55/BNI_logo.svg',
            ],
            'bri_va' => [
                'bank' => 'BRI',
                'account_number' => '12800' . substr(preg_replace('/\D/', '', $order->customer_phone), -6),
                'account_name' => 'ZEEN PARFUM / ' . $order->customer_name,
                'type' => 'Virtual Account',
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/6/68/BANK_BRI_logo.svg',
            ],
            'bank_transfer' => [
                'bank' => 'BCA Manual',
                'account_number' => env('BCA_ACCOUNT_NUMBER', '8271928301'),
                'account_name' => env('BCA_ACCOUNT_NAME', 'ZEEN PARFUM OFFICIAL'),
                'type' => 'Rekening Resmi Perusahaan',
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg',
            ],
        ];

        $currentBank = $bankDetails[$order->payment_method] ?? $bankDetails['bank_transfer'];

        return view('pages.payment', compact('order', 'currentBank'));
    }

    public function simulatePay(Request $request, string $order_number)
    {
        $order = Order::where('order_number', $order_number)->firstOrFail();

        $order->update([
            'payment_status' => 'paid',
            'paid_at' => now(),
            'payment_reference' => 'SIMULATED-' . strtoupper(bin2hex(random_bytes(4))),
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil dikonfirmasi secara instan.',
                'status' => 'paid',
            ]);
        }

        return redirect()->route('payment.show', ['order_number' => $order->order_number])
            ->with('success', 'Pembayaran berhasil dikonfirmasi! Pesanan Anda segera diproses oleh atelier ZEEN PARFUM.');
    }

    public function uploadProof(Request $request, string $order_number)
    {
        $request->validate([
            'proof' => 'required|image|max:4096',
        ]);

        $order = Order::where('order_number', $order_number)->firstOrFail();

        $path = $request->file('proof')->store('payment_proofs', 'public');

        $order->update([
            'payment_proof' => $path,
            'payment_status' => 'reviewing',
        ]);

        return redirect()->route('payment.show', ['order_number' => $order->order_number])
            ->with('success', 'Bukti pembayaran berhasil diunggah. Tim finance kami sedang memverifikasi.');
    }

    public function invoice(string $order_number)
    {
        $order = Order::with('items')->where('order_number', $order_number)->firstOrFail();
        return view('pages.invoice', compact('order'));
    }
}
