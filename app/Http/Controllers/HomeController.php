<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promotion;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $promotions = Promotion::where('is_active', true)->get();

        // 12 items per page -> total 11 pages for 128 products
        $products = Product::orderBy('product_id', 'asc')->paginate(12);

        return view('home', compact('categories', 'promotions', 'products'));
    }
}
