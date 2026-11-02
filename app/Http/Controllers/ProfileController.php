<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // GET /profile (profile.show)
    public function show()
    {
        $user = Auth::user();
        $pastOrders = $user->orders()
            ->with('orderItems.product')
            ->orderBy('order_date', 'desc')
            ->get();

        return view('profile.show', compact('user', 'pastOrders'));
    }

    // PUT /profile (profile.update)
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'phone'     => ['required', 'regex:/^0[0-9]{9}$/'],
            'address'   => 'required|string',
            'password'  => 'nullable|confirmed|min:8',
        ]);

        $user->full_name = $validated['full_name'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];

        if (!empty($validated['password'])) {
            $user->password_hash = Hash::make($validated['password']);
        }

        $user->save();

        return back()->with('success', 'บันทึกการแก้ไขข้อมูลโปรไฟล์เรียบร้อยแล้ว');
    }
}
