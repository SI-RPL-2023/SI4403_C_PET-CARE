@extends('layouts.admin')

@section('content')
  <div class="container dashboard-title">
    <div class="underline position-relative dashboard">
      <h3 class="m-0 mb-5">Admin Dashboard</h3>
    </div>
    <div class="row gx-4 mt-4">
      <div class="col-4 mb-4">
        <div class="rounded-3 d-flex flex-column align-items-center justify-content-evenly shadow dashboard-info">
          <h2>@currency($orders->sum('subtotal'))</h2>
          <div class="bg-white rounded d-flex align-items-center justify-content-center dashboard-info-text">
            <h4 class="m-0">Total Income</h4>
          </div>
        </div>
      </div>
      <div class="col-4 mb-4">
        <div class="rounded-3 d-flex flex-column align-items-center justify-content-evenly shadow dashboard-info">
          <h2>{{ $productCount }}</h2>
          <div class="bg-white rounded d-flex align-items-center justify-content-center dashboard-info-text">
            <h4 class="m-0">Products</h4>
          </div>
        </div>
      </div>
      <div class="col-4 mb-4">
        <div class="rounded-3 d-flex flex-column align-items-center justify-content-evenly shadow dashboard-info">
          <h2>{{ $petOwnerCount }}</h2>
          <div class="bg-white rounded d-flex align-items-center justify-content-center dashboard-info-text">
            <h4 class="m-0">Pet Owners</h4>
          </div>
        </div>
      </div>
      <div class="col-4 mb-4">
        <div class="rounded-3 d-flex flex-column align-items-center justify-content-evenly shadow dashboard-info">
          <h2>{{ $vetCount }}</h2>
          <div class="bg-white rounded d-flex align-items-center justify-content-center dashboard-info-text">
            <h4 class="m-0">Vets</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection