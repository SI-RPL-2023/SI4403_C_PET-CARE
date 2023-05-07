@extends('layouts.main')

@section('content')
  <div class="container vet spacing">
    <div class="row justify-content-between gx-5">
      <div class="col-6">
        <div class="underline position-relative d-flex">
          <h2>Make Appointment</h2>
        </div>
      </div>
    </div>
    <div class="row g-4 mt-2">
      <div class="col-6 d-flex border border-2 border-top-0 border-start-0 border-bottom-0">
        <div class="shadow rounded-4 make-appointment-container-left">
          <div class="w-100 d-flex align-items-center rounded-4 p-3 make-appointment-header">
            <img src="{{ asset('storage/images/vets/' . $vet->image) }}" class="rounded-4" alt="">
            <div class="ms-4">
              <h4>Drh. {{ $vet->name }}</h4>
              <span>{{ $vet->location }}</span>
            </div>
          </div>
          <div class="w-100 make-appointment-body mt-4">
            <h4>About Vet</h4>
            <span>{{ $vet->about }}</span>
          </div>
          <div class="w-100 make-appointment-footer mt-4">
            <h4>Working Time</h4>
            <span>Mon-Fri, 9:00 AM-4:30 PM</span>
          </div>
        </div>
      </div>
      <div class="col-6 d-flex justify-content-end">
        <div class="shadow rounded-4 position-relative make-appointment-container-right">
          <form action="/vet/make-appointment/{{ $vet->vet_id }}" method="post">
            @csrf
            <div class="mb-2">
              <label for="pet_name" class="form-label">Pet Name</label>
              <input type="text" class="form-control @error('pet_name') is-invalid @enderror" id="pet_name" name="pet_name" value="{{ old('pet_name') }}">
              @error('pet_name')
                <div class="invalid-feedback text-danger">
                  {{ $message }}
                </div>
              @enderror 
            </div>
            <div class="mb-2">
              <label for="pet_type" class="form-label">Pet Type</label>
              <input type="text" class="form-control @error('pet_type') is-invalid @enderror" id="pet_type" name="pet_type" value="{{ old('pet_type') }}">
              @error('pet_type')
                <div class="invalid-feedback text-danger">
                  {{ $message }}
                </div>
              @enderror 
            </div>
            <div class="mb-2">
              <label for="date" class="form-label">Date</label>
              <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date">
              @error('date')
                <div class="invalid-feedback text-danger">
                  {{ $message }}
                </div>
              @enderror 
            </div>
            <div class="mb-2 radio-custom">
              <span class="mb-2 d-block">Time</span>
              <div class="row g-3">
                <div class="col-3">
                  <input type="radio" name="time" id="09:00AM" value="09:00 AM">
                  <label for="09:00AM" class="@error('time') border-danger @enderror">09:00 AM</label>
                </div>
                <div class="col-3">
                  <input type="radio" name="time" id="10:00AM" value="10:00 AM">
                  <label for="10:00AM" class="@error('time') border-danger @enderror">10:00 AM</label>
                </div>
                <div class="col-3">
                  <input type="radio" name="time" id="11:00AM" value="11:00 AM">
                  <label for="11:00AM" class="@error('time') border-danger @enderror">11:00 AM</label>
                </div>
                <div class="col-3">
                  <input type="radio" name="time" id="12:00PM" value="12:00 PM">
                  <label for="12:00PM" class="@error('time') border-danger @enderror">12:00 PM</label>
                </div>
                <div class="col-3">
                  <input type="radio" name="time" id="13:00PM" value="13:00 PM">
                  <label for="13:00PM" class="@error('time') border-danger @enderror">13:00 PM</label>
                </div>
                <div class="col-3">
                  <input type="radio" name="time" id="14:00PM" value="14:00 PM">
                  <label for="14:00PM" class="@error('time') border-danger @enderror">14:00 PM</label>
                </div>
                <div class="col-3">
                  <input type="radio" name="time" id="15:00PM" value="15:00 PM">
                  <label for="15:00PM" class="@error('time') border-danger @enderror">15:00 PM</label>
                </div>
                <div class="col-3">
                  <input type="radio" name="time" id="16:00PM" value="16:00 PM">
                  <label for="16:00PM" class="@error('time') border-danger @enderror">16:00 PM</label>
                </div>
                @error('time')
                  <p class="text-danger" style="font-size: 14px">{{ $message }}</p>
                @enderror 
              </div>
            </div>
            <div class="position-absolute" style="bottom: 25px; right: 25px">
              <button type="submit" class="btn button-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection