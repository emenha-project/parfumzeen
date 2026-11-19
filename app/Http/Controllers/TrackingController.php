<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    /**
     * Show the order tracking search form.
     */
    public function index()
    {
        return view('pages.tracking');
    }

    /**
     * Show tracking result for an order number.
     */
    public function show(Request $request, string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->first();

        if (!$order) {
            return redirect()->route('tracking.index')
                ->with('error', 'Nomor pesanan tidak ditemukan. Periksa kembali nomor pesanan Anda.');
        }

        // Verify identity: phone or email (at least one must match)
        if ($request->has('phone') || $request->has('email')) {
            $phone = $request->input('phone');
            $email = $request->input('email');

            $phoneMatch = $phone && (
                $order->customer_phone === $phone ||
                $order->customer_phone === preg_replace('/^0/', '+62', $phone) ||
                preg_replace('/^0/', '+62', $order->customer_phone) === $phone
            );
            $emailMatch = $email && strtolower($order->customer_email) === strtolower($email);

            if (!$phoneMatch && !$emailMatch) {
                return redirect()->route('tracking.index')
                    ->with('error', 'Nomor telepon atau email tidak cocok dengan data pesanan.');
            }
        }

        return view('pages.tracking-result', compact('order'));
    }
}
