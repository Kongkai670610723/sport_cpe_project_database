@extends('layouts.app')

@section('title', 'Register — SPORT.CPE')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">
    <div class="text-center mb-6">
        <h1 class="text-2xl font-black text-slate-900">สมัครสมาชิก (Register)</h1>
        <p class="text-xs text-slate-500 mt-1">สร้างบัญชีสมาชิกใหม่เพื่อเริ่มช้อปอุปกรณ์กีฬา</p>
    </div>

    <form action="{{ route('register') }}" method="POST" class="space-y-3.5">
        @csrf
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Full Name</label>
            <input type="text" name="name" placeholder="นายก้องไกล ใจดี" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-accentOrange">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Email Address</label>
            <input type="email" name="email" placeholder="kongkai@cpe.eng.cmu.ac.th" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-accentOrange">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Phone Number</label>
            <input type="text" name="phone" placeholder="089-123-4567" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-accentOrange">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Password</label>
            <input type="password" name="password" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-accentOrange">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-accentOrange">
        </div>

        <button type="submit" class="w-full bg-accentGreen hover:bg-green-600 text-white font-bold py-3 rounded-xl text-sm transition shadow-sm mt-4">
            ลงทะเบียนสมาชิก
        </button>
    </form>
</div>
@endsection
