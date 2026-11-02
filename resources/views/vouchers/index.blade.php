@extends('layouts.app')

@section('title', 'Voucher Center — SPORT.CPE')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight">VOUCHER / คูปองส่วนลด</h1>
        <p class="text-slate-500 text-sm mt-1">กดเก็บโค้ดส่วนลดไปใช้ในหน้า Checkout ลดสูงสุด 20%</p>
    </div>
    <form action="{{ route('vouchers.claimAll') }}" method="POST">
        @csrf
        <button type="submit" class="bg-accentOrange hover:bg-orange-600 text-white font-bold px-5 py-2.5 rounded-xl text-sm transition shadow-sm">
            [ เก็บโค้ดทั้งหมด (Collect All) 🏷️ ]
        </button>
    </form>
</div>

<!-- Section 1: Discount Vouchers (3 Tickets) -->
<h2 class="text-lg font-black text-slate-900 mb-4 flex items-center gap-2">
    <span>🏷️</span> คูปองส่วนลดพิเศษ (Discount Vouchers)
</h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
    <!-- Ticket 1: SAVE15 (Orange) -->
    <div class="bg-accentOrange text-white rounded-2xl p-6 shadow-md relative overflow-hidden flex flex-col justify-between">
        <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider font-extrabold opacity-90">ลด 15%</span>
            <h3 class="text-2xl font-black">โค้ด: SAVE15</h3>
            <p class="text-xs opacity-90">ขั้นต่ำ ฿1,000 • หมวดวิ่งและอุปกรณ์</p>
        </div>
        <div class="pt-6">
            <button class="w-full bg-white text-accentOrange hover:bg-orange-50 font-black py-2.5 rounded-xl text-xs uppercase tracking-wider shadow-sm transition">
                [ เก็บโค้ด ]
            </button>
        </div>
    </div>

    <!-- Ticket 2: PERKS20 (Blue) -->
    <div class="bg-blue-700 text-white rounded-2xl p-6 shadow-md relative overflow-hidden flex flex-col justify-between">
        <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider font-extrabold opacity-90">ลด 20%</span>
            <h3 class="text-2xl font-black">โค้ด: PERKS20</h3>
            <p class="text-xs opacity-90">ขั้นต่ำ ฿2,000 • สิทธิพิเศษนักกีฬา</p>
        </div>
        <div class="pt-6">
            <span class="block w-full bg-green-500 text-white text-center font-black py-2.5 rounded-xl text-xs uppercase tracking-wider shadow-sm">
                [ เก็บแล้ว ✓ ]
            </span>
        </div>
    </div>

    <!-- Ticket 3: FREESHIP (Teal) -->
    <div class="bg-teal-600 text-white rounded-2xl p-6 shadow-md relative overflow-hidden flex flex-col justify-between">
        <div class="space-y-1">
            <span class="text-xs uppercase tracking-wider font-extrabold opacity-90">ส่งฟรี (Free Shipping)</span>
            <h3 class="text-2xl font-black">โค้ด: FREESHIP</h3>
            <p class="text-xs opacity-90">ขั้นต่ำ ฿500 • บริการจัดส่งด่วน</p>
        </div>
        <div class="pt-6">
            <button class="w-full bg-white text-teal-700 hover:bg-teal-50 font-black py-2.5 rounded-xl text-xs uppercase tracking-wider shadow-sm transition">
                [ เก็บโค้ด ]
            </button>
        </div>
    </div>
</div>

<!-- Section 2: Store Promotion Banner (BUY2GET1) -->
<h2 class="text-lg font-black text-slate-900 mb-4 flex items-center gap-2">
    <span>🏸</span> แคมเปญโปรโมชันอัตโนมัติ (Store Promotions - Buy X Get Y)
</h2>
<div class="bg-white rounded-3xl border border-slate-200 p-6 md:p-8 flex flex-col md:flex-row items-center justify-between gap-6 shadow-sm">
    <div class="flex items-center gap-6">
        <div class="w-20 h-20 rounded-2xl bg-orange-100 text-accentOrange flex items-center justify-center text-4xl shrink-0">
            🏸
        </div>
        <div class="space-y-2">
            <h3 class="text-xl md:text-2xl font-black text-slate-900">โปรโมชันซื้อ 2 แถม 1 อัตโนมัติ (BUY 2 GET 1 FREE)</h3>
            <p class="text-xs bg-green-100 text-green-700 font-bold px-3 py-1 rounded-full inline-block">
                ไม่ต้องใช้โค้ด • ระบบคำนวณให้อัตโนมัติใน Cart & Checkout
            </p>
            <p class="text-xs text-slate-500">ซื้อไม้แบดมินตัน Yonex Astrox 99 Pro จำนวน 2 ชิ้น รับฟรีทันที ลูกแบดมินตัน Aerosensa 50 (1 หลอด มูลค่า ฿1,200)</p>
        </div>
    </div>
    <a href="{{ route('products.index', ['category' => 'badminton']) }}" class="px-6 py-3 bg-accentOrange hover:bg-orange-600 text-white font-bold rounded-xl text-sm transition shadow-sm whitespace-nowrap">
        [ ไปช้อปหมวด Badminton → ]
    </a>
</div>
@endsection
