@extends('layouts.app')

@section('title', 'Login — SPORT.CPE')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">
    <div class="text-center mb-6">
        <h1 class="text-2xl font-black text-slate-900">เข้าสู่ระบบ (Login)</h1>
        <p class="text-xs text-slate-500 mt-1">เข้าสู่ระบบเพื่อสั่งซื้อและดูประวัติคำสั่งซื้อ</p>
    </div>

    <form action="{{ route('login') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Email Address</label>
            <input type="email" name="email" value="kongkai@cpe.eng.cmu.ac.th" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-accentOrange">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Password</label>
            <input type="password" name="password" value="password123" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-accentOrange">
        </div>

        <button type="submit" class="w-full bg-primary hover:bg-slate-800 text-white font-bold py-3 rounded-xl text-sm transition shadow-sm">
            เข้าสู่ระบบ (Login)
        </button>
    </form>

    <div class="pt-4 border-t border-slate-100 text-center text-xs text-slate-500 mt-6">
        ยังไม่มีบัญชีสมาชิก? <a href="{{ route('register') }}" class="text-accentOrange font-bold hover:underline">สมัครสมาชิกที่นี่</a>
    </div>
</div>
@endsection
