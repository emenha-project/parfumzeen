<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)
            ->orderBy('order_position')
            ->get();

        $featuredProducts = Product::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('id', 'asc')
            ->take(8)
            ->get();

        $bestsellers = Product::where('is_active', true)
            ->where('is_bestseller', true)
            ->take(6)
            ->get();

        $newArrivals = Product::where('is_active', true)
            ->where('is_new', true)
            ->take(4)
            ->get();

        $spotlightProduct = Product::where('slug', 'scentplus-noir-oud')->first() ?? $featuredProducts->first();

        return view('pages.home', compact(
            'categories',
            'featuredProducts',
            'bestsellers',
            'newArrivals',
            'spotlightProduct'
        ));
    }
}

