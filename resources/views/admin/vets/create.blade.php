@extends('layouts.admin')

@section('content')
  <div class="container mb-4 dashboard-title">
    <div class="underline position-relative">
      <h3 class="m-0 mb-5">Add Vet</h3>
    </div>
    <div class="row mt-4">
      <div class="col-8">
        <form action="/dashboard/vets" method="post" enctype="multipart/form-data">
          @csrf
          <div class="mb-2">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
            @error('email')
              <div class="invalid-feedback text-danger">
                {{ $message }}
              </div>
            @enderror 
          </div>
          <div class="mb-2">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
            @error('name')
              <div class="invalid-feedback text-danger">
                {{ $message }}
              </div>
            @enderror 
          </div>
          <div class="mb-2">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
            @error('phone')
              <div class="invalid-feedback text-danger">
                {{ $message }}
              </div>
            @enderror 
          </div>
          <div class="mb-2">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}">
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
            <label for="about" class="form-label">About</label>
            <textarea class="form-control @error('about') is-invalid @enderror" id="about" name="about" rows="6">{{ old('about') }}</textarea>
            @error('about')
              <div class="invalid-feedback text-danger">
                {{ $message }}
              </div>
            @enderror 
          </div>
          <div class="mb-2">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
            @error('password')
              <div class="invalid-feedback text-danger">
                {{ $message }}
              </div>
            @enderror 
          </div>
          <div class="mb-2">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" name="confirm_password">
            @error('confirm_password')
              <div class="invalid-feedback text-danger">
                {{ $message }}
              </div>
            @enderror 
          </div>
          <button type="submit" class="btn button-primary mt-2">Add</button>
        </form>
      </div>
      <div class="col-4 d-flex justify-content-center">
        <img class="img-thumbnail rounded-4 vet-img-preview" style="margin-top: 31px; display: none"/>
      </div>
    </div>
  </div>
@endsection

@section('myscript')
  <script>
    function previewImage() {
      const image = document.getElementById('image');
      const vetImgPreview = document.querySelector('.vet-img-preview');
      const oFReader = new FileReader();

      vetImgPreview.style.display = 'block';

      oFReader.readAsDataURL(image.files[0]);
      oFReader.onload = function(oFREvent) {
        vetImgPreview.src = oFREvent.target.result;
      }
    }
  </script>
@endsection