<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('subtitle', 'like', "%{$search}%")
                  ->orWhere('fragrance_family', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subtitle' => 'nullable|string|max:255',
            'concentration' => 'nullable|string|max:100',
            'fragrance_family' => 'nullable|string|max:100',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'badge' => 'nullable|string|max:50',
            'image' => 'required|string|max:500',
            'top_notes' => 'nullable|string|max:255',
            'heart_notes' => 'nullable|string|max:255',
            'base_notes' => 'nullable|string|max:255',
            'longevity' => 'nullable|string|max:100',
            'sillage' => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        
        // Ensure slug uniqueness
        $baseSlug = $validated['slug'];
        $count = 1;
        while (Product::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = "{$baseSlug}-{$count}";
            $count++;
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_bestseller'] = $request->boolean('is_bestseller');
        $validated['is_new'] = $request->boolean('is_new');

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Parfum mahakarya berhasil ditambahkan ke katalog!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subtitle' => 'nullable|string|max:255',
            'concentration' => 'nullable|string|max:100',
            'fragrance_family' => 'nullable|string|max:100',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'badge' => 'nullable|string|max:50',
            'image' => 'required|string|max:500',
            'top_notes' => 'nullable|string|max:255',
            'heart_notes' => 'nullable|string|max:255',
            'base_notes' => 'nullable|string|max:255',
            'longevity' => 'nullable|string|max:100',
            'sillage' => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        if ($product->name !== $validated['name']) {
            $newSlug = Str::slug($validated['name']);
            $baseSlug = $newSlug;
            $count = 1;
            while (Product::where('slug', $newSlug)->where('id', '!=', $product->id)->exists()) {
                $newSlug = "{$baseSlug}-{$count}";
                $count++;
            }
            $validated['slug'] = $newSlug;
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_bestseller'] = $request->boolean('is_bestseller');
        $validated['is_new'] = $request->boolean('is_new');

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Detail parfum berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        $name = $product->name;
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', "Parfum '{$name}' berhasil dihapus dari katalog.");
    }
}

