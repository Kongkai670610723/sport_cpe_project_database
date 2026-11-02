<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderController extends Controller
{
    // GET /orders (orders.index)
    public function index()
    {
        $orders = Order::with('orderItems.product')
            ->where('user_id', Auth::id())
            ->orderBy('order_date', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

    // POST /orders (orders.store) - ACID Database Transaction
    public function store(Request $request)
    {
        $user = Auth::user();
        $cart = session()->get('cart', []);

        $newOrder = DB::transaction(function () use ($user, $cart, $request) {
            $subtotal = 0.00;
            $totalDiscount = 0.00;

            foreach ($cart as $item) {
                $subtotal += $item['price'] * $item['quantity'];
                $freeQty = !empty($item['promo_eligible']) ? intdiv($item['quantity'], 3) : 0;
                $totalDiscount += $freeQty * $item['price'];
            }

            $netTotal = max(0, $subtotal - $totalDiscount);

            // 1. Insert into orders table
            $order = Order::create([
                'user_id'          => $user->user_id,
                'promo_id'         => $totalDiscount > 0 ? 3 : null,
                'order_date'       => now(),
                'subtotal'         => $subtotal,
                'total_discount'   => $totalDiscount,
                'net_amount'       => $netTotal,
                'shipping_address' => $request->input('shipping_address', $user->address),
                'payment_method'   => $request->input('payment_method', 'PromptPay'),
                'order_status'     => 'Pending',
            ]);

            // 2. Insert each line into order_items & decrement stock_qty in products
            foreach ($cart as $productId => $item) {
                $freeQty = !empty($item['promo_eligible']) ? intdiv($item['quantity'], 3) : 0;
                $itemDiscount = $freeQty * $item['price'];
                $itemTotal = ($item['price'] * $item['quantity']) - $itemDiscount;

                OrderItem::create([
                    'order_id'               => $order->order_id,
                    'product_id'             => $productId,
                    'quantity'               => $item['quantity'],
                    'unit_price_at_purchase' => $item['price'],
                    'discount_amount'        => $itemDiscount,
                    'free_qty'               => $freeQty,
                    'item_total'             => $itemTotal,
                ]);

                Product::where('product_id', $productId)->decrement('stock_qty', $item['quantity']);
            }

            session()->forget('cart');
            return $order;
        });

        return redirect()->route('orders.show', $newOrder->order_id);
    }

    // GET /orders/{id} (orders.show)
    public function show($id)
    {
        $order = Order::with(['orderItems.product', 'user'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('orders.complete', compact('order'));
    }
}
