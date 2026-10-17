<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $totalStock = Product::sum('stock');

        // Produk dengan stok rendah (query dipakai dua kali: hitung dan ambil daftar)
        $lowStockQuery = Product::where('stock', '<=', Product::LOW_STOCK_LIMIT);

        $lowStockCount = (clone $lowStockQuery)->count();
        $lowStockProducts = (clone $lowStockQuery)
            ->with('category')
            ->orderBy('stock')
            ->limit(10)
            ->get();

        // Total stok per kategori untuk grafik batang
        $categoryStocks = Category::withSum('products', 'stock')
            ->orderByDesc('products_sum_stock')
            ->get();

        // Nilai terbesar dipakai sebagai 100% lebar batang (minimal 1 supaya tidak dibagi nol)
        $maxCategoryStock = max(1, (int) $categoryStocks->max('products_sum_stock'));

        return view('admin.dashboard', compact(
            'totalCategories',
            'totalProducts',
            'totalStock',
            'lowStockCount',
            'lowStockProducts',
            'categoryStocks',
            'maxCategoryStock'
        ));
    }
}