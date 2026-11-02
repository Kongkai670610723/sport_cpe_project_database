<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;

class VoucherController extends Controller
{
    // GET /vouchers (vouchers.index)
    public function index()
    {
        $promotions = Promotion::where('is_active', true)->get();
        $claimedCodes = session()->get('claimed_vouchers', []);

        return view('vouchers.index', compact('promotions', 'claimedCodes'));
    }

    // POST /vouchers (vouchers.store) - Single-claim per voucher code
    public function store(Request $request)
    {
        $code = strtoupper($request->input('promo_code', 'ALL'));
        $claimed = session()->get('claimed_vouchers', []);

        if ($code === 'ALL') {
            session()->put('claimed_vouchers', ['SAVE15', 'PERKS20', 'SPORT10']);
            return back()->with('success', 'เก็บโค้ดส่วนลดทั้งหมดเรียบร้อยแล้ว!');
        }

        if (in_array($code, $claimed, true)) {
            return back()->withErrors(['promo_code' => "โค้ด {$code} ถูกเก็บไว้แล้ว ไม่สามารถกดรับซ้ำได้"]);
        }

        $claimed[] = $code;
        session()->put('claimed_vouchers', $claimed);

        return back()->with('success', "เก็บโค้ดส่วนลด {$code} สำเร็จแล้ว!");
    }
}
