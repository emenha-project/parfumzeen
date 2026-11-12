<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true);

        // Filter by category slug
        if ($request->filled('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Filter by scent family
        if ($request->filled('family')) {
            $query->where('fragrance_family', 'like', '%' . $request->family . '%');
        }

        // Search keyword
        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('subtitle', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%")
                  ->orWhere('top_notes', 'like', "%{$keyword}%")
                  ->orWhere('heart_notes', 'like', "%{$keyword}%")
                  ->orWhere('base_notes', 'like', "%{$keyword}%");
            });
        }

        // Sort
        match ($request->get('sort')) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'rating' => $query->orderBy('rating', 'desc'),
            'newest' => $query->orderBy('id', 'desc'),
            default => $query->orderBy('is_bestseller', 'desc')->orderBy('rating', 'desc'),
        };

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::where('is_active', true)->orderBy('order_position')->get();
        $families = ['Woody', 'Amber', 'Floral', 'Fresh', 'Gourmand', 'Discovery Set'];

        return view('pages.products.index', compact('products', 'categories', 'families'));
    }

    public function show(string $slug)
    {
        $product = Product::with(['category', 'reviews'])->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::where('id', '!=', $product->id)
            ->where('is_active', true)
            ->where(function ($q) use ($product) {
                $q->where('category_id', $product->category_id)
                  ->orWhere('fragrance_family', $product->fragrance_family);
            })
            ->take(4)
            ->get();

        return view('pages.products.show', compact('product', 'relatedProducts'));
    }
}
