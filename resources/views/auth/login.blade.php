@extends('layouts.auth')

@section('left-side')
  <div class="col-5 d-flex rounded-4 h-100 position-relative login">
    <div class="position-absolute home-container">
      <a href="/"><i class="fa-solid fa-home text-white home"></i></a>
    </div>
  </div>
@endsection

@section('right-side')
  <div class="col-7 d-flex align-items-center h-100">
    <div class="m-auto d-flex flex-column form">
      <img class="m-auto logo-login-register" src="images/logo.png" alt="Sobat Hewan">
      <h2 class="fw-bold mb-3 mt-4">Login</h2>
      @if (session()->has('login-failed'))
        <div class='alert alert-danger alert-dismissible' role='alert'>
          <span>{{ session('login-failed') }}</span>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      @if (session()->has('success'))
        <div class='alert alert-success alert-dismissible' role='alert'>
          <span>{{ session('success') }}</span>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      <form action="/login" method="post">
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
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-check mb-2">
          <input class="form-check-input" type="checkbox" id="remember" name="remember">
          <label class="form-check-label" for="remember">
            Remember me
          </label>
        </div>
        <button type="submit" class="btn button-primary px-4 mt-2">Login</button>
      </form>
      <p class="mt-3">Don't have an account yet? <a href="/register" class="link">Register</a></p>
    </div>
  </div>
@endsection