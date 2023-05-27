@extends('layouts.vet')

@section('content')
  <div class="row justify-content-between">
    <div class="col-4">
      <div class="underline position-relative d-flex justify-content-between my-article">
        <h3>Edit My Profile</h3>
      </div>
    </div>
  </div>
  <div class="mt-4 ps-1 pe-4 vet-profile-container">
    @if (session()->has('success'))
      <div class="row">
        <div class="col-12">
          <div class='alert alert-success alert-dismissible' role='alert'>
            <span>{{ session('success') }}</span>`
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
      </div>
    @endif
    <form action="/vetdashboard/editprofile" method="post" enctype="multipart/form-data">
      @method('put')
      @csrf
      <div class="mb-2">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
      </div>
      <div class="mb-2">
        <label for="name" class="form-label">Name</label>
          <div class="input-group">
            <span class="input-group-text">Drh.</span>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', auth()->user()->vet->name ) }}" autofocus>
          </div>
        @error('name')
          <div class="invalid-feedback text-danger">
            {{ $message }}
          </div>
        @enderror 
      </div>
      <div class="mb-2">
        <label for="phone" class="form-label">Phone</label>
        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', auth()->user()->vet->phone) }}">
        @error('phone')
          <div class="invalid-feedback text-danger">
            {{ $message }}
          </div>
        @enderror 
      </div>
      <div class="mb-2">
        <label for="location" class="form-label">Location</label>
        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', auth()->user()->vet->location) }}">
        @error('location')
          <div class="invalid-feedback text-danger">
            {{ $message }}
          </div>
        @enderror 
      </div>
      <div class="mb-2">
        <label for="image" class="form-label">Image</label>
        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" accept="image/*" onchange="previewImage()">
        @error('image')
          <div class="invalid-feedback text-danger">
            {{ $message }}
          </div>
        @enderror 
      </div>
      <div class="mb-2">
        <label for="about" class="form-label">About Me</label>
        <textarea class="form-control @error('about') is-invalid @enderror" id="about" name="about" rows="6">{{ old('about', auth()->user()->vet->about) }}</textarea>
        @error('about')
          <div class="invalid-feedback text-danger">
            {{ $message }}
          </div>
        @enderror 
      </div>
      <div class="mb-2">
        <label for="new_password" class="form-label">New Password</label>
        <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password">
        @error('new_password')
          <div class="invalid-feedback text-danger">
            {{ $message }}
          </div>
        @enderror 
      </div>
      <div class="mb-2">
        <label for="confirm_new_password" class="form-label">Confirm New Password</label>
        <input type="password" class="form-control @error('confirm_new_password') is-invalid @enderror" id="confirm_new_password" name="confirm_new_password">
        @error('confirm_new_password')
          <div class="invalid-feedback text-danger">
            {{ $message }}
          </div>
        @enderror 
      </div>
      <div class="text-end mt-3">
        <button type="submit" class="btn button-primary">Save</button>
      </div>
    </form>
  </div>
@endsection

@section('vet-card')
  <div class="shadow bg-white rounded-4 p-4 text-center position-relative align-items-center justify-content-center vet-id-card" style="display: none">
    <img class="img-fluid rounded-4 object-fit-cover img-preview" style="display: none; width: 250px; height: 235px">
  </div>
@endsection

@section('myscript')
  <script>
    function previewImage() {
      const image = document.getElementById('image');
      const imgPreview = document.querySelector('.img-preview');
      const vetCard = document.querySelector('.vet-id-card')
      const oFReader = new FileReader();

      vetCard.style.display = 'flex';
      imgPreview.style.display = 'block';

      oFReader.readAsDataURL(image.files[0]);
      oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
      }
    }
  </script>
@endsection