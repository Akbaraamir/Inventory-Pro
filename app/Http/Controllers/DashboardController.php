<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Gather stats for the cards
        $totalProducts = Product::count();
        $lowStockCount = Product::whereColumn('quantity', '<=', 'alert_level')->count();
        $totalValue = Product::select(DB::raw('SUM(price * quantity) as total'))->value('total') ?? 0;

        // 2. Prepare data for the Chart
        $categories = Category::withCount('products')->get();
        $labels = $categories->pluck('name'); 
        $counts = $categories->pluck('products_count');

        // 3. Send everything to the view
        return view('dashboard', compact(
            'totalProducts', 
            'lowStockCount', 
            'totalValue', 
            'labels', 
            'counts'
        ));
    }
}
