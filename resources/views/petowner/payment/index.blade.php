@extends('layouts.main')

@section('content')
  <div class="container vet spacing">
    <div class="row justify-content-between gx-5">
      <div class="col-6">
        <div class="underline position-relative d-flex">
          <h2>Payment</h2>
        </div>
      </div>
    </div>
    <div class="row g-4 mt-2 position-relative">
      <div class="col-6 d-flex border border-2 border-top-0 border-start-0 border-bottom-0">
        <div class="shadow rounded-4 payment-container-right">
          <form action="/payment" method="post">
            @csrf
            <div class="mb-2 radio-custom">
              <span class="mb-2 d-block">Shipping Options</span>
              <div class="row g-3">
                <div class="col-12">
                  <input type="radio" class="shipping" name="shipping" id="nextday" value="25000">
                  <label for="nextday" class="rounded-2 text-start @error('shipping') border-danger @enderror">Next Day | Rp25.000</label>
                </div>
                <div class="col-12">
                  <input type="radio" class="shipping" name="shipping" id="reguler" value="15000">
                  <label for="reguler" class="rounded-2 text-start @error('shipping') border-danger @enderror">Reguler | Rp15.000</label>
                </div>
                <div class="col-12">
                  <input type="radio" class="shipping" name="shipping" id="economy" value="8000">
                  <label for="economy" class="rounded-2 text-start @error('shipping') border-danger @enderror">Economy | Rp8.000</label>
                </div>
                @error('shipping')
                  <p class="text-danger" style="font-size: 14px">{{ $message }}</p>
                @enderror 
              </div>
            </div>
            <div class="mb-2">
              <label for="phone" class="form-label">Phone Number</label>
              <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', auth()->user()->petOwner->phone) }}">
              @error('phone')
                <div class="invalid-feedback text-danger">
                  {{ $message }}
                </div>
              @enderror 
            </div>
            <div class="mb-2">
              <label for="address" class="form-label">Address</label>
              <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="6">{{ old('address', auth()->user()->petOwner->address) }}</textarea>
              @error('address')
                <div class="invalid-feedback text-danger">
                  {{ $message }}
                </div>
              @enderror 
            </div>
            <div class="mb-2 radio-custom">
              <span class="mb-2 d-block">Payment Method</span>
              <div class="row g-3">
                <div class="col-3">
                  <input type="radio" name="payment" id="mandiri" value="Mandiri">
                  <label for="mandiri" class="rounded-2 text-center @error('payment') border-danger @enderror"><img src="/images/payments/mandiri.png" alt="Mandiri"></label>
                </div>
                <div class="col-3">
                  <input type="radio" name="payment" id="bca" value="BCA">
                  <label for="bca" class="rounded-2 text-center @error('payment') border-danger @enderror"><img src="/images/payments/bca.png" alt="BCA"></label>
                </div>
                <div class="col-3">
                  <input type="radio" name="payment" id="dana" value="Dana">
                  <label for="dana" class="rounded-2 text-center @error('payment') border-danger @enderror"><img src="/images/payments/dana.png" alt="Dana"></label>
                </div>
                <div class="col-3">
                  <input type="radio" name="payment" id="gopay" value="Gopay">
                  <label for="gopay" class="rounded-2 text-center @error('payment') border-danger @enderror"><img src="/images/payments/gopay.png" alt="Gopay"></label>
                </div>
                @error('payment')
                  <p class="text-danger" style="font-size: 14px">{{ $message }}</p>
                @enderror 
              </div>
            </div>
            <div class="position-absolute" style="bottom: 0; right: 0">
              <form action="/payment" method="post">
                @csrf
                <button type="submit" class="btn button-primary">Confirm Payment</button>
              </form>
            </div>
          </form>
        </div>
      </div>
      <div class="col-6 d-flex flex-column align-items-end">
        <div class="shadow rounded-4 payment-container-right">
          <h3>Order Summary</h3>
          <div class="row mt-3 order-summary">
            @foreach ($carts as $cart)
              <div class="col-9">
                <span class="text-muted">x{{ $cart->quantity }} {{ $cart->product->name }}</span>
              </div>
              <div class="col-3">
                <span class="text-muted">@currency($cart->subtotal)</span>
              </div>
            @endforeach
          </div>
          <hr>
          <div class="row order-summary">
            <div class="col-9">
              <span class="text-muted d-block">Delivery</span>
            </div>
            <div class="col-3">
              <span class="text-muted d-block shipping-price"></span>
            </div>
          </div>
          <hr>
          <div class="row order-summary">
            <div class="col-9">
              <span class="fw-bold">Order Total</span>
            </div>
            <div class="col-3">
              <span class="fw-bold order-total">@currency($carts->sum('subtotal'))</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('myscript')
  <script>
    const shippings = document.querySelectorAll('.shipping');
    console.log(shippings)
    shippings.forEach((shipping) => {
      shipping.addEventListener('click', function() {
        console.log(this.value);
        const shippingPrice = document.querySelector('.shipping-price');
        const orderTotal = document.querySelector('.order-total');
        
        shippingPrice.textContent = convertToRupiah(this.value);
        orderTotal.innerHTML = convertToRupiah(parseInt(this.value) + {{ $carts->sum('subtotal') }});
      })
    })

    function convertToRupiah(angka)
      {
        let rupiah = '';		
        let angkarev = angka.toString().split('').reverse().join('');
        for(let i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
        return 'Rp'+rupiah.split('',rupiah.length-1).reverse().join('');
      }
  </script>
@endsection