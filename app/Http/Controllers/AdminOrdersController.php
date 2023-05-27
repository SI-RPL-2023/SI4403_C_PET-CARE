<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrdersController extends Controller
{
    public function index() {
        $invoices = Order::select('invoice_no', 'status')->distinct()->get();

        return view('admin.orders.index', compact('invoices'));
    }

    public function update(Order $order) {
        $order->update([
            'status' => 'On delivery'
        ]);

        return redirect('/dashboard/orders')->with('success', 'Product is on delivery now');
    }

    public function show(Request $request) {
        $orders = Order::where('invoice_no', $request->invoice_no)->get();

        return view('admin.orders.detail', compact('orders'));
    }
}
