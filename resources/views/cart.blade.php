@extends('layouts.app')

@section('title', 'Your Cart — SPORT.CPE')

@section('content')
<!-- Stepper Header -->
<div class="max-w-2xl mx-auto mb-8">
    <div class="flex items-center justify-between text-xs font-bold text-slate-500">
        <span class="text-primary font-black">1. Cart [●]</span>
        <span class="h-0.5 flex-1 bg-slate-300 mx-4"></span>
        <span>2. Checkout</span>
        <span class="h-0.5 flex-1 bg-slate-300 mx-4"></span>
        <span>3. Complete</span>
    </div>
</div>

<h1 class="text-2xl md:text-3xl font-black text-slate-900 mb-6 tracking-tight">YOUR CART</h1>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    <!-- Left: Cart Items (~65%) -->
    <div class="lg:col-span-8 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm divide-y divide-slate-100">
        @foreach($cart as $id => $item)
            <div class="py-5 first:pt-0 last:pb-0 flex items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <img src="{{ $item['image'] }}" class="w-20 h-20 rounded-xl bg-slate-50 object-contain p-2 border border-slate-100">
                    <div>
                        <h3 class="font-bold text-slate-900 text-base">{{ $item['name'] }}</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Brand: {{ $item['brand'] }} • {{ $item['category'] }}</p>
                        <div class="font-extrabold text-slate-900 text-base mt-2">฿{{ number_format($item['price'], 0) }}</div>
                    </div>
                </div>

                <div class="flex flex-col items-end gap-3">
                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-dangerRed hover:opacity-80 text-sm" title="Remove item">🗑</button>
                    </form>
                    <div class="flex items-center border border-slate-200 rounded-lg overflow-hidden bg-slate-50 text-xs font-bold">
                        <span class="px-2.5 py-1 text-slate-600">-</span>
                        <span class="px-3 py-1 bg-white border-x border-slate-200">{{ $item['quantity'] }}</span>
                        <span class="px-2.5 py-1 text-slate-600">+</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Right: Order Summary (~35%) -->
    <div class="lg:col-span-4 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4">
        <h2 class="text-lg font-bold text-slate-900 border-b pb-3">Order Summary</h2>

        <div class="space-y-2.5 text-sm">
            <div class="flex justify-between text-slate-600">
                <span>Subtotal</span>
                <span class="font-semibold text-slate-900">฿{{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="flex justify-between text-dangerRed font-semibold">
                <span>Discount (BUY2GET1)</span>
                <span>-฿{{ number_format($discount, 2) }}</span>
            </div>
            <div class="flex justify-between text-slate-600">
                <span>Delivery Fee</span>
                <span class="text-green-600 font-semibold">Free</span>
            </div>
            <div class="border-t pt-3 flex justify-between items-center">
                <span class="font-bold text-base text-slate-900">Total</span>
                <span class="font-black text-2xl text-slate-900">฿{{ number_format($total, 2) }}</span>
            </div>
        </div>

        <!-- Voucher Code Input -->
        <div class="flex gap-2 pt-2">
            <input type="text" placeholder="Add promo code" class="flex-1 bg-slate-50 border border-slate-300 rounded-lg px-3 py-2 text-xs focus:outline-none">
            <button class="bg-primary text-white font-bold px-4 py-2 rounded-lg text-xs hover:bg-slate-800">Apply</button>
        </div>

        <a href="{{ route('checkout.index') }}" class="block w-full bg-primary hover:bg-slate-800 text-white font-bold py-3.5 rounded-xl text-center text-sm transition shadow-sm mt-4">
            Go to Checkout →
        </a>
    </div>
</div>
@endsection
