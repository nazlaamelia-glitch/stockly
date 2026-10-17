<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $latestProducts = Product::with('category')->latest()->limit(4)->get();

        return view('user.dashboard', compact('totalProducts', 'totalCategories', 'latestProducts'));
    }

    public function index(Request $request)
    {
        $products = Product::with('category')
            ->when($request->q, fn ($query, $search) => $query->where('name', 'like', "%{$search}%"))
            ->when($request->category, fn ($query, $categoryId) => $query->where('category_id', $categoryId))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('user.products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $product->load('category');

        return view('user.products.show', compact('product'));
    }
}