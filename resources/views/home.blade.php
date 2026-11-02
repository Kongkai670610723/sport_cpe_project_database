@extends('layouts.app')

@section('title', 'SPORT.CPE — Home')

@section('content')
<!-- Hero Promotion Banner (Frame 1 Master Design) -->
<div class="bg-white rounded-2xl p-6 md:p-8 mb-10 shadow-sm border border-slate-200 flex flex-col md:flex-row items-center justify-between gap-6">
    <div class="flex items-center gap-6">
        <div class="w-24 h-24 md:w-32 md:h-32 rounded-xl bg-slate-100 flex items-center justify-center text-4xl md:text-5xl shrink-0 shadow-inner">
            🏸⚽🏀
        </div>
        <div>
            <h1 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                BUY 2 GET <span class="text-accentOrange">1 FREE</span>
            </h1>
            <p class="text-slate-500 font-medium text-base md:text-lg mt-1">on selected sports gear</p>
        </div>
    </div>

    <!-- Voucher Quick Tickets -->
    <div class="flex flex-col sm:flex-row items-center gap-3">
        <div class="bg-accentOrange text-white px-4 py-2.5 rounded-lg font-bold text-center border-2 border-dashed border-orange-200 shadow-sm">
            <div class="text-xs uppercase tracking-wider opacity-90">Coupon</div>
            <div class="text-base font-extrabold">SAVE15 (15% OFF)</div>
        </div>
        <div class="bg-accentOrange text-white px-4 py-2.5 rounded-lg font-bold text-center border-2 border-dashed border-orange-200 shadow-sm">
            <div class="text-xs uppercase tracking-wider opacity-90">Coupon</div>
            <div class="text-base font-extrabold">PERKS20 (20% OFF)</div>
        </div>
        <a href="{{ route('vouchers.index') }}" class="bg-slate-900 hover:bg-slate-800 text-white px-5 py-3 rounded-lg font-bold text-sm transition shadow-sm">
            Shop Voucher →
        </a>
    </div>
</div>

<!-- Featured Products Section -->
<div class="mb-12">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-black text-slate-900">Featured Products</h2>
        <a href="{{ route('products.index', ['category' => 'badminton']) }}" class="text-accentOrange font-semibold text-sm hover:underline">
            ดูสินค้าตามหมวดหมู่ →
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($featuredProducts as $item)
            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm hover:shadow-md transition flex flex-col justify-between group">
                <div class="relative overflow-hidden rounded-xl bg-slate-50 h-56 mb-4 flex items-center justify-center p-4">
                    <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="max-h-full object-contain group-hover:scale-105 transition duration-300">
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">{{ $item->brand }}</span>
                    <h3 class="font-bold text-slate-900 text-base line-clamp-2 mt-1 mb-3">{{ $item->name }}</h3>
                </div>
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
</div>

<!-- Catalog Pagination (1-11 Pages Matching Database 128 items) -->
<div class="flex flex-col items-center justify-center py-6 border-t border-slate-200">
    <div class="text-xs text-slate-500 mb-3 font-medium">
        แสดงสินค้าในระบบทั้งหมด 128 ชิ้น (หน้าละ 12 ชิ้น • รวม 11 หน้า)
    </div>
    <div class="flex items-center gap-1.5">
        <span class="text-sm font-semibold text-slate-700 mr-2">Page</span>
        <a href="{{ route('home', ['page' => 1]) }}" class="w-9 h-9 rounded-lg bg-primary text-white font-bold flex items-center justify-center text-sm shadow-sm">1</a>
        <a href="{{ route('home', ['page' => 2]) }}" class="w-9 h-9 rounded-lg bg-white border border-slate-300 text-slate-700 hover:bg-slate-100 font-medium flex items-center justify-center text-sm">2</a>
        <a href="{{ route('home', ['page' => 3]) }}" class="w-9 h-9 rounded-lg bg-white border border-slate-300 text-slate-700 hover:bg-slate-100 font-medium flex items-center justify-center text-sm">3</a>
        <span class="px-2 text-slate-400 font-bold">......</span>
        <a href="{{ route('home', ['page' => 10]) }}" class="w-9 h-9 rounded-lg bg-white border border-slate-300 text-slate-700 hover:bg-slate-100 font-medium flex items-center justify-center text-sm">10</a>
        <a href="{{ route('home', ['page' => 11]) }}" class="w-9 h-9 rounded-lg bg-white border border-slate-300 text-slate-700 hover:bg-slate-100 font-medium flex items-center justify-center text-sm">11</a>
        <a href="{{ route('home', ['page' => 2]) }}" class="px-3 h-9 rounded-lg bg-white border border-slate-300 text-slate-700 hover:bg-slate-100 font-medium flex items-center justify-center text-sm ml-1">
            Next →
        </a>
    </div>
</div>
@endsection
