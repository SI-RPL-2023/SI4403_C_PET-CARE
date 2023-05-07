@extends('layouts.main')

@section('content')
  <div class="container my-order spacing">
    <div class="row justify-content-between gx-5">
      <div class="col-6">
        <div class="underline position-relative">
          <h2>My Appointment</h2>
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
      @if ($appointment)
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Vet Name</th>
                  <th>Pet Name</th>
                  <th>Pet Type</th>
                  <th>Date & Time</th>
                  <th>Update Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Drh. {{ $appointment->vet->name }}</td>
                  <td>{{ $appointment->pet_name }}</td>
                  <td>{{ $appointment->pet_type }}</td>
                  <td>{{ date('j F Y', strtotime($appointment->date)) }}, {{ $appointment->time }}</td>
                  <td>
                    <form action="/myappointment/{{ $appointment->id }}" method="post">
                      @method('put')
                      @csrf
                      <button type="submit" class="badge button-secondary border-0">End Appointment</button>
                    </form>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      @else
        <div class="d-flex align-items-center justify-content-center" style="height: 400px">
          <h4 class="text-muted not-added">You haven't made an appointment</h4>
        </div>
      @endif
    </div>
  </div>
@endsection