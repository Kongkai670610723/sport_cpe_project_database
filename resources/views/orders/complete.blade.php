@extends('layouts.app')

@section('title', 'Order Complete — SPORT.CPE')

@section('content')
<!-- Stepper Header -->
<div class="max-w-2xl mx-auto mb-8">
    <div class="flex items-center justify-between text-xs font-bold text-slate-500">
        <span class="text-green-600">1. Cart [✓]</span>
        <span class="h-0.5 flex-1 bg-green-500 mx-4"></span>
        <span class="text-green-600">2. Checkout [✓]</span>
        <span class="h-0.5 flex-1 bg-green-500 mx-4"></span>
        <span class="text-primary font-black">3. Complete [●]</span>
    </div>
</div>

<div class="max-w-xl mx-auto bg-white rounded-3xl border border-slate-200 p-8 md:p-10 text-center shadow-sm">
    <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-2xl mx-auto mb-4 font-bold">
        ✓
    </div>

    <h1 class="text-2xl font-black text-slate-900 mb-2">Thank you for your order!</h1>
    <p class="text-slate-500 text-sm mb-6">คำสั่งซื้อของคุณได้รับการยืนยันและกำลังเตรียมจัดส่ง</p>

    <!-- Receipt Details Box -->
    <div class="bg-slate-50 rounded-2xl p-6 text-left border border-slate-100 space-y-2.5 text-xs md:text-sm text-slate-700 mb-6">
        <div class="flex justify-between border-b pb-2">
            <span class="text-slate-500">Order Number</span>
            <span class="font-bold text-slate-900">#{{ $order->order_id }}</span>
        </div>
        <div class="flex justify-between border-b pb-2">
            <span class="text-slate-500">Date</span>
            <span>Nov 1, 2026, 17:30 น.</span>
        </div>
        <div class="flex justify-between border-b pb-2">
            <span class="text-slate-500">Payment Method</span>
            <span class="text-green-600 font-bold">PromptPay QR (Paid ✓)</span>
        </div>
        <div class="flex justify-between border-b pb-2">
            <span class="text-slate-500">Total Paid</span>
            <span class="font-extrabold text-slate-900 text-base">฿{{ number_format($order->total_amount, 2) }}</span>
        </div>
        <div class="pt-2">
            <span class="text-slate-500 block mb-1">Shipping Address:</span>
            <p class="font-medium text-slate-800">{{ $order->shipping_address }}</p>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex items-center justify-center gap-4">
        <a href="{{ route('home') }}" class="px-6 py-3 bg-primary hover:bg-slate-800 text-white rounded-xl font-bold text-sm transition">
            Back to Home →
        </a>
        <a href="{{ route('profile') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl font-bold text-sm transition">
            View Order History
        </a>
    </div>
</div>
@endsection
