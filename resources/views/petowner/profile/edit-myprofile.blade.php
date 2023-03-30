@extends('layouts.main')

@section('content')
  <div class="container spacing profile">
    <div class="position-relative underline">
      <h2>Edit My Profile</h2>
    </div>
    <form action="/myprofile" method="post" enctype="multipart/form-data">
      @method('put')
      @csrf
      <div class="row mt-4 gx-5 position-relative">
        <div class="col-8">
          <div class="border border-2 rounded-4 p-4">
            <div class="mb-2">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
            </div>
            <div class="mb-2">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', auth()->user()->petOwner->name) }}" autofocus>
              @error('name')
                <div class="invalid-feedback text-danger">
                  {{ $message }}
                </div>
              @enderror 
            </div>
            <div class="mb-2">
              <label for="phone" class="form-label">Phone Number</label>
              <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', auth()->user()->petOwner->phone) }}">
              @error('phone')
                <div class="invalid-feedback text-danger">
                  {{ $message }}
                </div>
              @enderror 
            </div>
            <div class="mb-2">
              <label for="birth_date" class="form-label">Birth Date</label>
              <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date', auth()->user()->petOwner->birth_date) }}">
              @error('birth_date')
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
              <label for="address" class="form-label">Address</label>
              <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="4">{{ old('address', auth()->user()->petOwner->address) }}</textarea>
              @error('address')
                <div class="invalid-feedback text-danger">
                  {{ $message }}
                </div>
              @enderror 
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="border border-2 rounded-4 p-4 d-flex justify-content-center align-items-center">
            <img class="rounded-4 profile-picture img-fluid img-preview" src="@if(auth()->user()->petOwner->image != null){{ asset('storage/images/petowner-pp/' . auth()->user()->petOwner->image) }}@else{{ "/images/no-pp.jpg" }}@endif" alt="{{ auth()->user()->petOwner->name }}"/>
          </div>
        </div>
        <div class="col-8 mt-4">
          <div class="position-relative underline">
            <h2>Change Password</h2>
          </div>
          <div class="border border-2 rounded-4 p-4 mt-4">
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
          </div>
        </div>
        <div class="position-absolute w-100 text-end edit">
          <button type="submit" class="btn button-primary">Save</button>
        </div>
      </div>
    </form>
  </div>
@endsection

@section('myscript')
  <script>
    function previewImage() {
      const image = document.getElementById('image');
      const imgPreview = document.querySelector('.img-preview');
      const oFReader = new FileReader();

      imgPreview.style.display = 'block';

      oFReader.readAsDataURL(image.files[0]);
      oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
        changeImg.style.display = 'none';
      }
    }
  </script>
@endsection