<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categorySlug = $request->get('category', 'badminton');
        $categories = Category::all();

        $query = Product::with('promotions');

        if ($categorySlug !== 'all') {
            $cat = Category::where('category_name', 'like', "%{$categorySlug}%")->first();
            if ($cat) {
                $query->where('category_id', $cat->category_id);
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%");
            });
        }

        // 12 products per page (Page 1: 12 items, Page 2: 4 remaining items)
        $products = $query->paginate(12);

        return view('products.index', compact('products', 'categories', 'categorySlug'));
    }

    public function show($id)
    {
        $product = Product::with(['category', 'promotions'])->findOrFail($id);

        return view('products.show', compact('product'));
    }
}
