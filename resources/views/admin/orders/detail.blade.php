@extends('layouts.admin')

@section('content')
  <div class="container dashboard-title">
    <div class="underline position-relative dashboard">
      <h3 class="m-0 mb-5">Order Detail</h3>
    </div>
    <div class="row">
      <h5 class="mb-4">Invoice No. {{ $orders[0]->invoice_no }}</h5>
      <div class="col-12">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
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