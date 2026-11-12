<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('info', 'Tas belanja Anda masih kosong.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $freeShippingThreshold = 500000;
        $shippingFee = ($subtotal >= $freeShippingThreshold) ? 0 : 25000;
        $grandTotal = $subtotal + $shippingFee;

        return view('pages.checkout', compact('cart', 'subtotal', 'shippingFee', 'grandTotal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:150',
            'customer_email' => 'required|email|max:150',
            'customer_phone' => 'required|string|max:30',
            'customer_address' => 'required|string|max:500',
            'customer_city' => 'required|string|max:100',
            'customer_province' => 'nullable|string|max:100',
            'customer_postal_code' => 'nullable|string|max:20',
            'customer_notes' => 'nullable|string|max:500',
            'payment_method' => 'required|in:qris,bca_va,mandiri_va,bni_va,bri_va,bank_transfer',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shippingFee = ($subtotal >= 500000) ? 0 : 25000;
        $grandTotal = $subtotal + $shippingFee;

        // Generate unique order number: ZEEN-YYYYMMDD-XXXX
        $orderNumber = 'ZEEN-' . date('Ymd') . '-' . strtoupper(Str::random(5));

        // Create order
        $order = Order::create([
            'order_number' => $orderNumber,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'customer_city' => $request->customer_city,
            'customer_province' => $request->customer_province ?? 'DKI Jakarta',
            'customer_postal_code' => $request->customer_postal_code,
            'customer_notes' => $request->customer_notes,
            'subtotal' => $subtotal,
            'shipping_fee' => $shippingFee,
            'discount_amount' => 0,
            'grand_total' => $grandTotal,
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
            'payment_reference' => 'PAY-' . strtoupper(Str::random(10)),
            'expired_at' => now()->addMinutes(60),
        ]);

        // Save order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'] ?? null,
                'product_name' => $item['name'],
                'size' => $item['size'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
                'image' => $item['image'] ?? null,
            ]);
        }

        // Clear cart
        session()->forget('cart');

        return redirect()->route('payment.show', ['order_number' => $order->order_number]);
    }
}
