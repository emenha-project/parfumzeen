<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('items')->latest();

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->filled('order_status')) {
            $query->where('order_status', $request->order_status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%");
            });
        }

        $orders = $query->paginate(15)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.product');
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update payment status (old functionality retained)
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:pending,reviewing,paid,expired,failed,cancelled',
        ]);

        $order->payment_status = $validated['payment_status'];
        if ($validated['payment_status'] === 'paid' && !$order->paid_at) {
            $order->paid_at = now();
            // Auto-confirm order when payment confirmed
            if ($order->order_status === 'pending') {
                $order->addTrackingEvent('confirmed', 'Pembayaran telah dikonfirmasi oleh admin ZEEN.');
            }
        }
        $order->save();

        return redirect()->route('admin.orders.show', $order)
            ->with('success', "Status pembayaran #" . $order->order_number . " diubah ke " . strtoupper($order->payment_status));
    }

    /**
     * Update order/delivery status (tracking)
     */
    public function updateOrderStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'order_status'        => 'required|in:pending,confirmed,packed,shipped,in_transit,delivered,cancelled',
            'courier'             => 'nullable|string|max:100',
            'resi_number'         => 'nullable|string|max:100',
            'estimated_delivery'  => 'nullable|date',
            'tracking_note'       => 'nullable|string|max:500',
        ]);

        // Update order fields
        if ($validated['courier'] ?? null) {
            $order->courier = $validated['courier'];
        }
        if ($validated['resi_number'] ?? null) {
            $order->resi_number = $validated['resi_number'];
        }
        if ($validated['estimated_delivery'] ?? null) {
            $order->estimated_delivery = $validated['estimated_delivery'];
        }

        // Add tracking event (updates order_status automatically)
        $note = $validated['tracking_note'] ?? '';
        $order->addTrackingEvent($validated['order_status'], $note);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', "Status pengiriman #" . $order->order_number . " diperbarui → " . $order->order_status_label);
    }
}
