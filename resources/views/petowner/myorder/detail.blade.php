@extends('layouts.main')

@section('content')
  <div class="container my-order spacing">
    <div class="row justify-content-between gx-5">
      <div class="col-6">
        <div class="underline position-relative">
          <h2>Order Detail</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <h5 class="my-4">Invoice No. {{ $orders[0]->invoice_no }}</h5>
      <div class="col-12">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr class="border border-2 border-bottom border-top border-start-0 border-end-0">
                <th>No</th>
                <th>Image</th>
                <th>Product</th>
                <th>Quantity</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td><img src="{{ asset('storage/images/products/' . $order->product->image) }}" alt="{{ $order->product->name }}" width="100px"></td>
                  <td>{{ $order->product->name }}</td>
                  <td>{{ $order->quantity }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection