<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('sku', 'LIKE', "%{$search}%");
        }

        $products = $query->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'sku' => 'required|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'alert_level' => 'required|integer|min:0',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    // --- NEW: EDIT METHOD ---
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // --- NEW: UPDATE METHOD ---
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'sku' => 'required|unique:products,sku,' . $product->id,
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'alert_level' => 'required|integer|min:0',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    // --- NEW: DELETE METHOD ---
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }

    public function adjustStock(Request $request, Product $product)
    {
        if ($request->action === 'increase') {
            $product->increment('quantity');
        } elseif ($request->action === 'decrease') {
            if ($product->quantity > 0) {
                $product->decrement('quantity');
            } else {
                return redirect()->back()->with('error', 'Stock cannot be negative!');
            }
        }

        return redirect()->back()->with('success', 'Stock updated for ' . $product->name);
    }

    public function lowStock()
    {
        $products = Product::whereColumn('quantity', '<=', 'alert_level')
                           ->with('category')
                           ->get();

        return view('products.low-stock', compact('products'));
    }
}