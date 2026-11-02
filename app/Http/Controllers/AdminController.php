<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    // GET /admin/dashboard (admin.dashboard)
    public function index()
    {
        $totalRevenue = Order::where('order_status', '!=', 'Cancelled')->sum('total_amount');
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'customer')->count();

        $recentOrders = Order::with(['user', 'items.product', 'promotion'])->orderBy('order_id', 'desc')->get();
        $lowStockProducts = Product::where('stock_quantity', '<=', 10)->orderBy('stock_quantity', 'asc')->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'totalProducts',
            'totalCustomers',
            'recentOrders',
            'lowStockProducts'
        ));
    }

    // PUT /admin/orders/{id} & PUT /admin/products/{id}
    public function update(Request $request, $id)
    {
        if ($request->has('order_status')) {
            Order::where('order_id', $id)->update(['order_status' => $request->input('order_status')]);
            return back()->with('success', "อัปเดตสถานะออเดอร์ #{$id} เรียบร้อยแล้ว");
        }

        if ($request->has('add_quantity')) {
            $addQty = max(1, (int) $request->input('add_quantity', 10));
            Product::where('product_id', $id)->increment('stock_quantity', $addQty);
            return back()->with('success', "เติมสต็อกสินค้า #{$id} เพิ่ม +{$addQty} ชิ้น เรียบร้อยแล้ว");
        }

        if ($request->has('stock_qty') || $request->has('stock_quantity')) {
            $newStock = (int) $request->input('stock_quantity', $request->input('stock_qty', 25));
            Product::where('product_id', $id)->update(['stock_quantity' => $newStock]);
            return back()->with('success', "อัปเดตสต็อกสินค้า #{$id} เป็น {$newStock} ชิ้น เรียบร้อยแล้ว");
        }

        return back();
    }
}
