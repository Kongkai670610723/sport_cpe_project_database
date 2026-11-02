<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Promotion;

class CartController extends Controller
{
    // GET /cart (cart.index)
    public function index()
    {
        $cart = session()->get('cart', []);
        $subtotal = 0.00;
        $bogoDiscount = 0.00;

        foreach ($cart as $productId => &$item) {
            $lineSubtotal = $item['price'] * $item['quantity'];
            $subtotal += $lineSubtotal;

            // Per-Product Buy 2 Get 1 Free (must buy >= 3 units of the exact same eligible product)
            $freeQty = !empty($item['promo_eligible']) ? intdiv($item['quantity'], 3) : 0;
            $itemDiscount = $freeQty * $item['price'];

            $item['free_qty'] = $freeQty;
            $item['discount_amount'] = $itemDiscount;
            $bogoDiscount += $itemDiscount;
        }

        $total = max(0, $subtotal - $bogoDiscount);

        return view('cart.index', compact('cart', 'subtotal', 'bogoDiscount', 'total'));
    }

    // POST /cart (cart.store)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,product_id',
            'quantity'   => 'nullable|integer|min:1',
        ]);

        $product = Product::with('promotions')->findOrFail($validated['product_id']);
        $qty = $validated['quantity'] ?? 1;
        $cart = session()->get('cart', []);

        $isBuy2Get1 = $product->promotions->contains('promo_code', 'BUY2GET1');

        if (isset($cart[$product->product_id])) {
            $cart[$product->product_id]['quantity'] += $qty;
        } else {
            $cart[$product->product_id] = [
                'id'             => $product->product_id,
                'name'           => $product->name,
                'brand'          => $product->brand,
                'category'       => $product->category->category_name ?? 'Sports',
                'price'          => $product->price,
                'quantity'       => $qty,
                'promo_eligible' => $isBuy2Get1,
                'image'          => $product->image_url,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'เพิ่มสินค้าลงในตะกร้าเรียบร้อยแล้ว');
    }

    // PUT /cart/{id} (cart.update)
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        $qty = (int) $request->input('quantity', 1);

        if ($qty <= 0) {
            unset($cart[$id]);
        } elseif (isset($cart[$id])) {
            $cart[$id]['quantity'] = $qty;
        }

        session()->put('cart', $cart);
        return back()->with('success', 'อัปเดตจำนวนสินค้าในตะกร้าเรียบร้อยแล้ว');
    }

    // DELETE /cart/{id} (cart.destroy)
    public function destroy($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return back()->with('success', 'ลบสินค้าออกจากตะกร้าเรียบร้อยแล้ว');
    }
}
