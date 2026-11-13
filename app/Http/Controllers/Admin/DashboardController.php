<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSales = Order::where('payment_status', 'paid')->sum('grand_total');
        $totalOrders = Order::count();
        $pendingOrders = Order::whereIn('payment_status', ['pending', 'reviewing'])->count();
        $totalProducts = Product::where('is_active', true)->count();

        $recentOrders = Order::with('items')
            ->orderBy('id', 'desc')
            ->take(8)
            ->get();

        return view('admin.dashboard', compact(
            'totalSales',
            'totalOrders',
            'pendingOrders',
            'totalProducts',
            'recentOrders'
        ));
    }
}

