@extends('layouts.main')

@section('content')
  <div class="container foods-stuffs spacing">
    <div class="row justify-content-between gx-5">
      <div class="col-6">
        <div class="underline position-relative">
          <h2>Cart</h2>
        </div>
      </div>
    </div>
    @if ($carts->count())
      <div class="row mt-5">
        <div class="col-12">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr class="fw-bold">
                  <td>Remove</td>
                  <td>Image</td>
                  <td>Product</td>
                  <td>Quantity</td>
                  <td>Price</td>
                  <td>Subtotal</td>
                </tr>
              </thead>
              <tbody class="list-product">
                @foreach ($carts as $cart)    
                  <tr>
                    <td>
                      <form action="/shop/cart/{{ $cart->id }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="border-0 bg-transparent rounded-circle remove"><i class="bi bi-x-circle"></i></button>
                      </form>
                    </td>
                    <td><img src="{{ asset('storage/images/products/' . $cart->product->image) }}" alt="" width="100px"></td>
                    <td>{{ $cart->product->name }}</td>
                    <td>{{ $cart->quantity }}</td>
                    <td>@currency($cart->product->price)</td>
                    <td>@currency($cart->subtotal)</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div> 
      <div class="row justify-content-center mt-5">
        <div class="col-6 d-flex justify-content-between align-items-center rounded-3 py-3 px-4 total-container">
          <h4 class="mt-2">Total</h4>
          <h4 class="mt-2">@currency($carts->sum('subtotal'))</h4>
          <a href="/payment" class="btn button-secondary">Checkout</a>
        </div>
      </div> 
    @else
      <div class="d-flex align-items-center justify-content-center" style="height: 400px">
        <h4 class="text-muted not-added">Your cart is still empty</h4>
      </div>
    @endif
  </div>
@endsection

@section('myscript')
  <script>
    const quantities = document.querySelectorAll('#quantity');
    
    quantities.forEach((quantity) => {
      quantity.addEventListener('change', function() {
        const cartId = this.previousElementSibling.textContent;
        
        fetch(`/shop/cart/${cartId}/update?quantity=` + quantity.value)
          .then(response => response.json())
          .then(data => quantity.value = data.value)
      })
    })
  </script>
@endsection