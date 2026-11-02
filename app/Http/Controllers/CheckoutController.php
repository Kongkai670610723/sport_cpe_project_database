<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // GET /checkout (checkout.index)
    public function index()
    {
        $user = Auth::user();
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('warning', 'ตะกร้าสินค้าของคุณยังว่างอยู่');
        }

        $subtotal = 0.00;
        $discount = 0.00;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
            $freeQty = !empty($item['promo_eligible']) ? intdiv($item['quantity'], 3) : 0;
            $discount += $freeQty * $item['price'];
        }

        $total = max(0, $subtotal - $discount);

        return view('checkout.index', compact('user', 'cart', 'subtotal', 'discount', 'total'));
    }
}
