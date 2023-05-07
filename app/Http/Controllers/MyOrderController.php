<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class MyOrderController extends Controller
{
    public function index() {
        $invoices = Order::where('pet_owner_id', auth()->user()->petOwner->pet_owner_id)->select('invoice_no', 'status')->distinct()->get();

        return view('petowner.myorder.index', compact('invoices'));
    }

    public function update(Order $order) {
        $order->update([
            'status' => 'Completed'
        ]);

        return redirect('/myorder')->with('success', 'Order has been completed');
    }

    public function show(Request $request) {
        $orders = Order::where('invoice_no', $request->invoice_no)->get();

        return view('petowner.myorder.detail', compact('orders'));
    }
}
