@extends('layouts.invoice')

@section('content')
  <div class="container-fluid bg-light min-vh-100 d-flex justify-content-center align-items-center">
    <div class="col-5 bg-white border rounded p-5 overflow-auto my-5" style="min-height: 80vh;">
      <h4 class="text-center mb-5">Thanks for your order</h4>
      <div class="d-flex flex-column">
        <span class="text-muted" style="font-size: 14px;">{{ $orders[0]->petOwner->name }}</span>
        <span class="text-muted" style="font-size: 14px;">Invoice No. {{ $orders[0]->invoice_no }}</span>
        <span class="text-muted" style="font-size: 14px;">{{ date_format($orders[0]->created_at, 'j F Y') }}</span>
        <span class="text-muted" style="font-size: 14px;">Shipping to {{ $orders[0]->address }}</span>
      </div>
      <table class="table mt-3 table-borderless">
        <thead>
          <tr>
            <td scope="col" class="fw-bold text-start">Description</td>
            <td scope="col" class="fw-bold text-center">Quantity</td>
            <td scope="col" class="text-end fw-bold">Subtotal</td>
          </tr>
        </thead>
        <tbody>
          @foreach ($orders as $order) 
            <tr>
              <td scope="row" class="text-muted text-start">{{ $order->product->name }}{{ $order->product->weight == null ? '' : ' | ' . $order->product->weight }}</td>
              <td class="text-muted text-center">{{ $order->quantity }}</td>
              <td class="text-end text-muted">@currency($order->subtotal)</td>
            </tr>
          @endforeach
          <tr class="border-top">
            <td scope="row" colspan="2" class="text-end text-muted">Delivery</td>
            <td class="text-end text-muted">@currency($orders[0]->shipping)</td>
          </tr>
          <tr class="border-bottom">
            <td scope="row" colspan="2" class="text-end fw-bold">Total</td>
            <td class="text-end fw-bold">@currency($orders->sum('subtotal') + $orders[0]->shipping)</td>
          </tr>
        </tbody>
      </table>
      <div class="text-center mt-5">
        <a href="/myorder" class="btn button-secondary">Check my order</a>
      </div>
    </div>
  </div>
@endsection