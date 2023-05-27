@extends('layouts.vet')

@section('content')
  <div class="row justify-content-between">
    <div class="col-6">
      <div class="underline position-relative d-flex justify-content-between my-article">
        <h3>Create New Article</h3>
      </div>
    </div>
    <div class="col-6 text-end">
      <a href="/vetdashboard/articles" class="btn button-secondary">Back</a>
    </div>
  </div>
  <div class="mt-4 ps-1 pe-4 article-container">
    <form action="/vetdashboard/articles" method="post" class="mb-4" enctype="multipart/form-data">
      @csrf
      <div class="mb-2">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" autofocus value="{{ old('title') }}">
        @error('title')
          <div class="invalid-feedback text-danger">
            {{ $message }}
          </div>
        @enderror 
      </div>
      <div class="mb-2">
        <label for="image" class="form-label">Post Image</label>
        <img class="img-preview img-fluid mb-2 col-6" alt="">
        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
        @error('title')
          <div class="invalid-feedback text-danger">
            {{ $message }}
          </div>
        @enderror 
      </div>
      <div class="mb-2">
        <label for="body" class="form-label">Body</label>
        <input id="body" type="hidden" name="body" value="{{ old('body') }}">
        <trix-editor input="body" class="@error('body') border-danger @enderror" style="min-height: 200px"></trix-editor>
        @error('body')
          <p class="text-danger mt-1" style="font-size: 14px">{{ $message }}</p>
        @enderror
      </div>
      <div class="text-end">
        <button type="button" class="btn button-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Create Article</button>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
          <div class="modal-content">
            <div class="modal-body text-center pt-5">Are you sure? The article can't be edited</div>
            <div class="d-flex justify-content-center">
              <button type="button" class="btn btn-danger me-2 my-3 px-4" data-bs-dismiss="modal">No</button>
              <button type="submit" class="btn button-primary my-3 px-4">Yes</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection

@section('vet-card')
  @include('partials.vet-card')
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
      }
    }
    
    document.addEventListener('trix-file-accept', function(e) {
      e.prevenDefault();
    })
  </script>
@endsection