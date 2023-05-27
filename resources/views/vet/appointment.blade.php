@extends('layouts.vet')

@section('content')
  <div class="row justify-content-between">
    <div class="col-4">
      <div class="underline position-relative d-flex justify-content-between my-article">
        <h3>My Appointment</h3>
      </div>
    </div>
  </div>
  <div class="mt-4 appointment-container">
    <div class="row g-4 me-2">
      @if($appointments->count())
        @foreach ($appointments as $appointment)
          <div class="col-4 appointment-profile">
            <div class="rounded-4 p-4" style="background-color: #c7e7e1">
              <div class="d-flex align-items-center">
                <img src="@if($appointment->petOwner->image != null){{ asset('storage/images/petowner-pp/' . $appointment->petOwner->image) }}@else{{ "/images/no-pp.jpg" }}@endif" class="rounded-circle appointment-profile-picture me-2" alt="{{ $appointment->petOwner->name }}">
                <div class="ms-2">
                  <span class="d-block fw-bold">{{ $appointment->petOwner->name }}</span>
                  <span class="text-muted"><i class="fa-solid fa-paw me-2"></i>{{ $appointment->pet_name }} | {{ $appointment->pet_type }}</span>
                </div>
              </div>
              <div class="mt-3">
                <span class="d-block mb-2 text-muted"><i class="fa-solid fa-calendar-days me-2"></i>{{ date('j F Y', strtotime($appointment->date)) }}, {{ $appointment->time }}</span>
                <span class="text-muted"><i class="fa-solid fa-location-dot me-2"></i>{{ $appointment->address }}</span>
              </div>
            </div>
          </div>
        @endforeach
      @else
        <div class="d-flex align-items-center justify-content-center" style="height: 400px">
          <h4 class="text-muted not-added">You have no appointment</h4>
        </div>
      @endif
    </div>
  </div>
@endsection

@section('vet-card')
  @include('partials.vet-card')
@endsection