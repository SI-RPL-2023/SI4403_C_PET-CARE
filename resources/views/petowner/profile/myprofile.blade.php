@extends('layouts.main')

@section('content')
  <div class="container spacing profile">
    <div class="position-relative underline">
      <h2>My Profile</h2>
    </div>
    <div class="row mt-4 gx-5 position-relative">
      <div class="col-8">
        <div class="border border-2 rounded-4 p-4">
          @if (session()->has('success'))
            <div class="row">
              <div class="col-12">
                <div class='alert alert-success alert-dismissible' role='alert'>
                  <span>{{ session('success') }}</span>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>
            </div>
          @endif
          <div class="mb-2">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
          </div>
          <div class="mb-2">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->petOwner->name }}" readonly>
          </div>
          <div class="mb-2">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="phone" name="phone" value="{{ auth()->user()->petOwner->phone }}" readonly>
          </div>
          <div class="mb-2">
            <label for="birth_date" class="form-label">Birth Date</label>
            <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ auth()->user()->petOwner->birth_date }}" readonly>
          </div>
          <div class="mb-2">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="4" readonly>{{ auth()->user()->petOwner->address }}</textarea>
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="border border-2 rounded-4 p-4 d-flex justify-content-center align-items-center">
          <img class="rounded-4 profile-picture img-fluid" src="@if(auth()->user()->petOwner->image != null){{ asset('storage/images/petowner-pp/' . auth()->user()->petOwner->image) }}@else{{ "/images/no-pp.jpg" }}@endif" alt="{{ auth()->user()->petOwner->name }}"/>
        </div>
      </div>
      <div class="position-absolute w-100 text-end edit">
        <a href="/myprofile/edit" class="btn button-primary edit-btn">Edit Profile</a>
      </div>
    </div>
  </div>
@endsection

