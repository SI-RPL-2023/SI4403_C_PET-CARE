<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index() {
        $products = Product::with('category')->get();
        if(auth()->check()) {
            $carts = Cart::where('pet_owner_id', auth()->user()->petOwner->pet_owner_id)->with('product')->get();
            return view('petowner.shop.index', compact('products', 'carts'));
        }

        return view('petowner.shop.index', compact('products'));
    }

    public function cart() {
        $carts = Cart::where('pet_owner_id', auth()->user()->petOwner->pet_owner_id)->with('product')->get();

        return view('petowner.shop.cart', compact('carts'));
    }

    public function store(Request $request, Product $product) {
        Cart::create([
            'pet_owner_id' => auth()->user()->petOwner->pet_owner_id,
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'subtotal' => $request->quantity * $product->price
        ]);

        return redirect('shop/cart');
    }

    public function destroy(Cart $cart) {
        $cart->destroy($cart->id);

        return redirect('shop/cart');
    }

    public function update() {
        
    }
}