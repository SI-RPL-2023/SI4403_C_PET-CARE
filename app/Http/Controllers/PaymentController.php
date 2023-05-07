<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class PaymentController extends Controller
{
    public function index() {
        $carts = Cart::where('pet_owner_id', auth()->user()->petOwner->pet_owner_id)->with('product')->get();
        
        return view('petowner.payment.index', compact('carts'));
    }

    public function productsPayment(Request $request) {
        $request->validate([
            'shipping' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'payment' => 'required'
        ]);

        $carts = Cart::where('pet_owner_id', auth()->user()->petOwner->pet_owner_id)->with('product')->get();
        $invoice_no = rand();

        foreach($carts as $cart) {
            Order::create([
                'pet_owner_id' => auth()->user()->petOwner->pet_owner_id,
                'product_id' => $cart->product->id,
                'invoice_no' => $invoice_no,
                'phone' => $request->phone,
                'address' => $request->address,
                'payment' => $request->payment,
                'quantity' => $cart->quantity,
                'subtotal' => $cart->subtotal,
                'shipping' => $request->shipping,
                'status' => 'On process'
            ]);

            Product::where('id', $cart->product_id)->update([
                'stock' => $cart->product->stock - $cart->quantity
            ]);
        }

        Cart::where('pet_owner_id', auth()->user()->petOwner->pet_owner_id)->delete();
        Session::put('invoice_no', $invoice_no);

        return redirect('/payment/invoice');
    }

    public function invoice() {
        $orders = Order::where('invoice_no', Session::get('invoice_no'))->get();

        return view('petowner.payment.invoice', compact('orders'));
    }
}
