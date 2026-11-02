@extends('layouts.app')

@section('title', $product->name . ' — SPORT.CPE')

@section('content')
<!-- Breadcrumbs -->
<div class="flex items-center gap-2 text-xs text-slate-500 mb-6 font-medium">
    <a href="{{ route('home') }}" class="hover:text-slate-800">Home</a>
    <span>></span>
    <a href="{{ route('products.index', ['category' => 'badminton']) }}" class="hover:text-slate-800">Badminton</a>
    <span>></span>
    <span class="text-slate-900 font-semibold truncate">{{ $product->name }}</span>
</div>

<!-- Main Product Stage (2 Columns) -->
<div class="bg-white rounded-3xl border border-slate-200 p-6 md:p-10 shadow-sm mb-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
        <!-- Left: Image Box -->
        <div class="space-y-4">
            <div class="bg-slate-50 rounded-2xl p-8 flex items-center justify-center h-96 border border-slate-100">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="max-h-full object-contain">
            </div>
            <div class="grid grid-cols-4 gap-3">
                <div class="border-2 border-accentOrange rounded-xl p-2 bg-slate-50 h-20 flex items-center justify-center cursor-pointer">
                    <img src="{{ $product->image_url }}" class="max-h-full object-contain">
                </div>
                <div class="border border-slate-200 rounded-xl p-2 bg-slate-50 h-20 flex items-center justify-center cursor-pointer opacity-60 hover:opacity-100">
                    <span class="text-xs text-slate-400 font-bold">มุมก้าน</span>
                </div>
                <div class="border border-slate-200 rounded-xl p-2 bg-slate-50 h-20 flex items-center justify-center cursor-pointer opacity-60 hover:opacity-100">
                    <span class="text-xs text-slate-400 font-bold">มุมหัวไม้</span>
                </div>
                <div class="border border-slate-200 rounded-xl p-2 bg-slate-50 h-20 flex items-center justify-center cursor-pointer opacity-60 hover:opacity-100">
                    <span class="text-xs text-slate-400 font-bold">ด้ามจับ</span>
                </div>
            </div>
        </div>

        <!-- Right: Buy Box -->
        <div class="space-y-5">
            <div>
                <span class="inline-block px-3 py-1 bg-slate-100 text-slate-700 font-bold text-xs rounded-full uppercase tracking-wider mb-2">
                    {{ $product->brand }}
                </span>
                <h1 class="text-2xl md:text-3xl font-black text-slate-900 leading-tight">
                    {{ $product->name }}
                </h1>
                <p class="text-slate-600 text-sm mt-3 leading-relaxed">
                    {{ $product->description }}
                </p>
            </div>

            <!-- Price & Promo -->
            <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100 space-y-2">
                <div class="text-3xl font-black text-slate-900">
                    ฿{{ number_format($product->price, 0) }} Baht
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-0.5 bg-green-100 text-green-700 font-bold text-xs rounded">
                        ✓ Buy 2 Get 1 Free Eligible
                    </span>
                    <span class="text-xs text-slate-500 font-medium">
                        ● In Stock: {{ $product->stock_quantity }} items remaining
                    </span>
                </div>
            </div>

            <!-- Add to Cart Form -->
            <form action="{{ route('cart.add', $product->product_id) }}" method="POST" class="space-y-4 pt-2">
                @csrf
                <div class="flex items-center gap-4">
                    <span class="text-sm font-semibold text-slate-700">Quantity:</span>
                    <div class="flex items-center border border-slate-300 rounded-lg overflow-hidden bg-white">
                        <button type="button" class="px-3 py-1.5 text-slate-600 hover:bg-slate-100 font-bold">-</button>
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}" class="w-12 text-center text-sm font-bold border-x border-slate-300 py-1.5 focus:outline-none">
                        <button type="button" class="px-3 py-1.5 text-slate-600 hover:bg-slate-100 font-bold">+</button>
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="flex-1 bg-accentGreen hover:bg-green-600 text-white font-bold py-3.5 px-6 rounded-xl transition shadow-sm text-sm">
                        Add to Cart
                    </button>
                    <a href="{{ route('checkout.index') }}" class="flex-1 bg-accentOrange hover:bg-orange-600 text-white font-bold py-3.5 px-6 rounded-xl transition shadow-sm text-sm text-center">
                        Buy Now
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
