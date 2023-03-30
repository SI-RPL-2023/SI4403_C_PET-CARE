@extends('layouts.auth')

@section('left-side')
  <div class="col-5 d-flex rounded-4 h-100 position-relative register">
    <div class="position-absolute home-container">
      <a href="/"><i class="fa-solid fa-home text-white home"></i></a>
    </div>
  </div>
@endsection

@section('right-side')
  <div class="col-7 d-flex align-items-center h-100 position-relative">
    <div class="m-auto d-flex flex-column form">
      <img class="m-auto logo-login-register" src="images/logo.png" alt="Sobat Hewan">
      <h2 class="fw-bold mb-3 mt-4">Register</h2>
      <form action="/register" method="post">
        @csrf
        <div class="mb-2">
          <label for="email" class="form-label @error('email') text-danger @enderror">Email</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
          @error('email')
            <div class="invalid-feedback text-danger">
              {{ $message }}
            </div>
          @enderror 
        </div>
        <div class="mb-2">
          <label for="name" class="form-label @error('name') text-danger @enderror">Name</label>
          <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
          @error('name')
            <div class="invalid-feedback text-danger">
              {{ $message }}
            </div>
          @enderror 
        </div>
        <div class="mb-2">
          <label for="password" class="form-label @error('password') text-danger @enderror">Password</label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
          @error('password')
            <div class="invalid-feedback text-danger">
              {{ $message }}
            </div>
          @enderror 
        </div>
        <div class="mb-2">
          <label for="confirm_password" class="form-label @error('confirm_password') text-danger @enderror">Confirm Password</label>
          <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" name="confirm_password">
          @error('confirm_password')
            <div class="invalid-feedback text-danger">
              {{ $message }}
            </div>
          @enderror 
        </div>
        <button type="submit" class="btn button-primary px-4 mt-2">Register</button>
      </form>
      <p class="mt-3">Already have an account? <a href="/login" class="link">Login</a></p>
    </div>
  </div>
@endsection