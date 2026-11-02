@extends('layouts.app')

@section('title', 'Checkout — SPORT.CPE')

@section('content')
<!-- Stepper Header -->
<div class="max-w-2xl mx-auto mb-8">
    <div class="flex items-center justify-between text-xs font-bold text-slate-500">
        <span class="text-green-600">1. Cart [✓]</span>
        <span class="h-0.5 flex-1 bg-green-500 mx-4"></span>
        <span class="text-primary font-black">2. Checkout [●]</span>
        <span class="h-0.5 flex-1 bg-slate-300 mx-4"></span>
        <span>3. Complete</span>
    </div>
</div>

<h1 class="text-2xl md:text-3xl font-black text-slate-900 mb-6">CHECKOUT</h1>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    <!-- Left Column: 3 Clean Cards -->
    <div class="lg:col-span-8 space-y-6">
        <!-- Card 1: Shipping Address -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <h2 class="font-bold text-slate-900 text-base flex items-center gap-2">
                    <span>📍</span> Shipping Address
                </h2>
                <span class="text-xs bg-green-100 text-green-700 font-bold px-2 py-0.5 rounded">Default Address</span>
            </div>
            <div class="text-sm text-slate-700 space-y-1">
                <p class="font-bold text-slate-900">Kongkai Jai-dee (089-123-4567)</p>
                <p class="text-slate-600">ภาควิชาวิศวกรรมคอมพิวเตอร์ คณะวิศวกรรมศาสตร์ มหาวิทยาลัยเชียงใหม่ 239 ถ.ห้วยแก้ว ต.สุเทพ อ.เมือง จ.เชียงใหม่ 50200</p>
            </div>
        </div>

        <!-- Card 2: Shipping Method -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
            <h2 class="font-bold text-slate-900 text-base mb-3 flex items-center gap-2">
                <span>🚚</span> Shipping Method
            </h2>
            <div class="flex items-center justify-between p-3.5 bg-slate-50 border border-slate-200 rounded-xl">
                <div>
                    <span class="font-bold text-slate-900 text-sm">Standard Delivery (Kerry / Flash Express)</span>
                    <p class="text-xs text-slate-500">คาดการณ์จัดส่งภายใน 1-2 วันทำการ</p>
                </div>
                <span class="font-bold text-green-600 text-sm">FREE</span>
            </div>
        </div>

        <!-- Card 3: Payment Method -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
            <h2 class="font-bold text-slate-900 text-base mb-3 flex items-center gap-2">
                <span>💳</span> Payment Method
            </h2>
            <div class="p-4 bg-slate-50 border-2 border-accentOrange rounded-xl flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="text-2xl">📱</span>
                    <div>
                        <span class="font-bold text-slate-900 text-sm">PromptPay QR Code</span>
                        <p class="text-xs text-slate-500">สแกนชำระผ่านแอปพลิเคชันทุกธนาคาร</p>
                    </div>
                </div>
                <span class="text-xs bg-orange-100 text-orange-700 font-bold px-2.5 py-1 rounded">Selected</span>
            </div>
        </div>
    </div>

    <!-- Right Column: Order Summary -->
    <div class="lg:col-span-4 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4">
        <h2 class="font-bold text-slate-900 text-base border-b pb-3">Order Summary</h2>

        <div class="text-xs text-slate-500 space-y-2">
            <div class="flex justify-between">
                <span>Yonex Astrox 99 Pro Racket x2</span>
                <span class="font-semibold text-slate-800">฿13,800.00</span>
            </div>
            <div class="flex justify-between">
                <span>Yonex Aerosensa 50 (12 pcs) x1</span>
                <span class="font-semibold text-slate-800">฿1,200.00</span>
            </div>
        </div>

        <div class="bg-orange-50 border border-orange-200 rounded-lg p-2.5 text-xs text-orange-800 font-medium">
            🏷️ Promo Applied: <strong>BUY2GET1</strong> (-฿1,200.00)
        </div>

        <div class="space-y-2 text-sm border-t pt-3">
            <div class="flex justify-between text-slate-600">
                <span>Subtotal</span>
                <span>฿15,000.00</span>
            </div>
            <div class="flex justify-between text-dangerRed font-semibold">
                <span>Discount</span>
                <span>-฿1,200.00</span>
            </div>
            <div class="flex justify-between text-slate-600">
                <span>Shipping</span>
                <span class="text-green-600 font-semibold">FREE</span>
            </div>
            <div class="flex justify-between items-center text-lg font-black text-slate-900 pt-2 border-t">
                <span>Total</span>
                <span>฿13,800.00</span>
            </div>
        </div>

        <!-- Place Order Button (ACID Transaction Trigger) -->
        <form action="{{ route('checkout.placeOrder') }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-accentOrange hover:bg-orange-600 text-white font-extrabold py-3.5 rounded-xl transition text-center text-sm shadow-md mt-4">
                Place Order (฿13,800) →
            </button>
        </form>
    </div>
</div>
@endsection
