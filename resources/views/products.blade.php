@extends('layouts.app')

@section('title', 'SPORT.CPE — แคตตาล็อกอุปกรณ์กีฬา')

@section('content')
<div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl md:text-3xl font-black text-slate-900 capitalize">
            {{ $categorySlug === 'all' ? 'อุปกรณ์กีฬาทั้งหมด' : $categorySlug . ' Equipment' }}
        </h1>
        <p class="text-slate-500 text-sm mt-0.5">พบทั้งหมด 16 รายการ • หน้า 1 (12 ชิ้นแรก)</p>
    </div>

    <!-- Filter Toggle -->
    <div class="flex items-center gap-3">
        <label class="flex items-center gap-2 bg-white border border-slate-300 px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-700 cursor-pointer">
            <input type="checkbox" checked class="text-accentOrange rounded">
            <span>Buy 2 Get 1 Free Eligible</span>
        </label>
        <select class="bg-white border border-slate-300 px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-700">
            <option>ราคา: ต่ำไปสูง</option>
            <option>ราคา: สูงไปต่ำ</option>
            <option selected>สินค้าแนะนำ</option>
        </select>
    </div>
</div>

<!-- 12 Product Cards Grid (3 Rows x 4 Columns) -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
    @foreach($products as $item)
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm hover:shadow-md transition flex flex-col justify-between group">
            <a href="{{ route('products.show', $item->product_id) }}" class="block">
                <div class="relative overflow-hidden rounded-xl bg-slate-50 h-52 mb-4 flex items-center justify-center p-4">
                    <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="max-h-full object-contain group-hover:scale-105 transition duration-300">
                </div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">{{ $item->brand }}</span>
                <h3 class="font-bold text-slate-900 text-base line-clamp-2 mt-1 mb-2 hover:text-accentOrange">{{ $item->name }}</h3>
                <p class="text-xs text-slate-500 line-clamp-1 mb-3">{{ $item->description }}</p>
            </a>
            <div class="flex items-center justify-between pt-3 border-t border-slate-100">
                <span class="font-extrabold text-slate-900 text-lg">฿{{ number_format($item->price, 0) }}</span>
                <form action="{{ route('cart.add', $item->product_id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-accentGreen hover:bg-green-600 text-white font-bold px-4 py-2 rounded-lg text-xs transition">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>
    @endforeach
</div>

<!-- Pagination (Page 1 of 2 for Badminton 16 items) -->
<div class="flex items-center justify-center gap-2 py-4 border-t border-slate-200">
    <span class="text-sm font-semibold text-slate-700 mr-2">Page</span>
    <span class="w-9 h-9 rounded-lg bg-primary text-white font-bold flex items-center justify-center text-sm shadow-sm">1</span>
    <a href="{{ route('products.index', ['category' => $categorySlug, 'page' => 2]) }}" class="w-9 h-9 rounded-lg bg-white border border-slate-300 text-slate-700 hover:bg-slate-100 font-medium flex items-center justify-center text-sm">
        2
    </a>
    <a href="{{ route('products.index', ['category' => $categorySlug, 'page' => 2]) }}" class="px-3 h-9 rounded-lg bg-white border border-slate-300 text-slate-700 hover:bg-slate-100 font-medium flex items-center justify-center text-sm">
        Next →
    </a>
</div>
@endsection
