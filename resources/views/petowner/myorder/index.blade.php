@extends('layouts.main')

@section('content')
  <div class="container my-order spacing">
    <div class="row justify-content-between gx-5">
      <div class="col-6">
        <div class="underline position-relative">
          <h2>My Order</h2>
        </div>
      </div>
    </div>
    <div class="row mt-5">
      @if (session()->has('success'))
        <div class="col-12">
          <div class='alert alert-success alert-dismissible' role='alert'>
            <span>{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
      @endif
      @if ($invoices->count())
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Invoice No</th>
                  <th>Detail</th>
                  <th>Status</th>
                  <th>Update Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($invoices as $invoice)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $invoice->invoice_no }}</td>
                    <td><a href="/myorder/detail?invoice_no={{ $invoice->invoice_no }}" class="badge button-secondary text-decoration-none">Show</a></td>
                    <td>{{ $invoice->status }}</td>
                    <td>
                      <form action="/myorder/{{ $invoice->invoice_no }}" method="post">
                        @method('put')
                        @csrf
                        <button type="submit" class="badge button-secondary border-0" {{ $invoice->status === "On process" || $invoice->status === 'Completed' ? 'disabled' : "" }}>Receive</button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      @else
        <div class="d-flex align-items-center justify-content-center" style="height: 400px">
          <h4 class="text-muted not-added">You haven't placed an order yet</h4>
        </div>
      @endif
    </div>
  </div>
@endsection