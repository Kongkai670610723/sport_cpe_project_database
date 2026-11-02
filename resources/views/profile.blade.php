@extends('layouts.app')

@section('title', 'Member Profile — SPORT.CPE')

@section('content')
<h1 class="text-2xl md:text-3xl font-black text-slate-900 mb-6">MEMBER PROFILE</h1>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    <!-- User Info Card (~35%) -->
    <div class="lg:col-span-4 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4">
        <div class="flex items-center gap-4 border-b pb-4">
            <div class="w-14 h-14 rounded-full bg-primary text-white text-xl font-black flex items-center justify-center">
                KK
            </div>
            <div>
                <h2 class="font-black text-slate-900 text-lg">Kongkai Jai-dee</h2>
                <span class="text-xs bg-green-100 text-green-700 font-bold px-2 py-0.5 rounded">Verified Member</span>
            </div>
        </div>

        <div class="space-y-3 text-xs md:text-sm text-slate-700">
            <div>
                <span class="text-slate-400 block text-xs">Email</span>
                <span class="font-bold">kongkai@cpe.eng.cmu.ac.th</span>
            </div>
            <div>
                <span class="text-slate-400 block text-xs">Phone</span>
                <span class="font-bold">089-123-4567</span>
            </div>
            <div>
                <span class="text-slate-400 block text-xs">Faculty / University</span>
                <span class="font-medium">วิศวกรรมคอมพิวเตอร์ มหาวิทยาลัยเชียงใหม่</span>
            </div>
            <div>
                <span class="text-slate-400 block text-xs">Default Shipping Address</span>
                <p class="font-medium text-slate-800 text-xs mt-1">239 ถ.ห้วยแก้ว ต.สุเทพ อ.เมือง จ.เชียงใหม่ 50200</p>
            </div>
        </div>
    </div>

    <!-- Past Orders Table (~65%) -->
    <div class="lg:col-span-8 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-bold text-slate-900 text-base">ประวัติคำสั่งซื้อ (Past Orders)</h2>
            <span class="text-xs text-slate-400">3 Orders Found</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs text-slate-500 font-bold uppercase border-b">
                    <tr>
                        <th class="p-4">Order ID</th>
                        <th class="p-4">Date</th>
                        <th class="p-4">Items Summary</th>
                        <th class="p-4">Total</th>
                        <th class="p-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700 text-xs md:text-sm">
                    <tr class="hover:bg-slate-50">
                        <td class="p-4 font-bold text-slate-900">#1011</td>
                        <td class="p-4 text-slate-500">Oct 30, 2026</td>
                        <td class="p-4">Yonex Astrox 99 Pro (1), Cushion 65 (1)</td>
                        <td class="p-4 font-bold">฿7,565.00</td>
                        <td class="p-4"><span class="px-2 py-0.5 rounded text-xs font-bold bg-orange-100 text-orange-700">Pending</span></td>
                    </tr>
                    <tr class="hover:bg-slate-50">
                        <td class="p-4 font-bold text-slate-900">#1006</td>
                        <td class="p-4 text-slate-500">Oct 25, 2026</td>
                        <td class="p-4">Speedo Fastskin Speedsocket 2 (2)</td>
                        <td class="p-4 font-bold">฿4,980.00</td>
                        <td class="p-4"><span class="px-2 py-0.5 rounded text-xs font-bold bg-green-100 text-green-700">Delivered</span></td>
                    </tr>
                    <tr class="hover:bg-slate-50">
                        <td class="p-4 font-bold text-slate-900">#1001</td>
                        <td class="p-4 text-slate-500">Oct 20, 2026</td>
                        <td class="p-4">Nike Air Zoom Pegasus 40 (1)</td>
                        <td class="p-4 font-bold">฿4,600.00</td>
                        <td class="p-4"><span class="px-2 py-0.5 rounded text-xs font-bold bg-green-100 text-green-700">Delivered</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
