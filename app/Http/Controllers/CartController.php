<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $freeShippingThreshold = 500000;
        $shippingFee = ($subtotal >= $freeShippingThreshold || $subtotal == 0) ? 0 : 25000;
        $grandTotal = $subtotal + $shippingFee;

        return view('pages.cart', compact('cart', 'subtotal', 'shippingFee', 'grandTotal', 'freeShippingThreshold'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'nullable|string',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $size = $request->size ?? $product->size_default;
        $quantity = (int) ($request->quantity ?? 1);

        // Price adjustment for 100ml (+60% usually) if selected
        $price = $product->price;
        if ($size === '100ml') {
            $price = $product->price * 1.6;
        }

        $cartKey = $product->id . '_' . $size;
        $cart = session()->get('cart', []);

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $quantity;
        } else {
            $cart[$cartKey] = [
                'id' => $cartKey,
                'product_id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'concentration' => $product->concentration,
                'size' => $size,
                'price' => $price,
                'quantity' => $quantity,
                'image' => $product->image,
            ];
        }

        session()->put('cart', $cart);

        if ($request->wantsJson()) {
            $totalCount = array_sum(array_column($cart, 'quantity'));
            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }
            return response()->json([
                'success' => true,
                'message' => "{$product->name} ({$size}) ditambahkan ke tas belanja.",
                'cart_count' => $totalCount,
                'cart_subtotal' => 'Rp ' . number_format($subtotal, 0, ',', '.'),
                'cart' => $cart,
            ]);
        }

        return redirect()->back()->with('success', "{$product->name} ({$size}) berhasil ditambahkan ke tas belanja.");
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = (int) $request->quantity;
            session()->put('cart', $cart);
        }

        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('cart.index')->with('success', 'Jumlah produk berhasil diperbarui.');
    }

    public function remove(Request $request)
    {
        $request->validate(['id' => 'required|string']);

        $cart = session()->get('cart', []);
        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }

        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari tas belanja.');
    }

    public function getMiniCart()
    {
        $cart = session()->get('cart', []);
        $totalCount = array_sum(array_column($cart, 'quantity'));
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        return response()->json([
            'count' => $totalCount,
            'subtotal' => 'Rp ' . number_format($subtotal, 0, ',', '.'),
            'items' => array_values($cart),
        ]);
    }
}
