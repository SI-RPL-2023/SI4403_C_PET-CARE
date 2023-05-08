@extends('layouts.admin')

@section('content')
  <div class="container mb-4 dashboard-title">
    <div class="underline position-relative">
      <h3 class="m-0 mb-5">Edit Product</h3>
    </div>
    <div class="row mt-4">
      <div class="col-8">
        <form action="/dashboard/products/{{ $product->slug }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
          <div class="mb-2">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}">
            @error('name')
              <div class="invalid-feedback text-danger">
                {{ $message }}
              </div>
            @enderror 
          </div>
          <div class="mb-2">
            <label for="weight" class="form-label">Weight</label>
            <input type="text" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" value="{{ old('weight', $product->weight) }}">
            @error('weight')
              <div class="invalid-feedback text-danger">
                {{ $message }}
              </div>
            @enderror 
          </div>
          <div class="mb-2">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" id="category" name="category_id">
              @foreach ($categories as $category)   
                @if (old('category_id', $product->category_id) == $category->id)  
                  <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                @else
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif           
              @endforeach
            </select>
          </div>
          <div class="mb-2">
            <label for="price" class="form-label">Price</label>
            <div class="input-group">
              <span class="input-group-text">Rp</span>
              <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', number_format($product->price, 0, ',' , '.')) }}">
              @error('price')
                <div class="invalid-feedback text-danger">
                  {{ $message }}
                </div>
              @enderror 
            </div>
          </div>
          <div class="mb-2">
            <label for="stock" class="form-label">Stock</label>
            <div class="input-group">
              <input type="text" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $product->stock) }}">
              @error('stock')
                <div class="invalid-feedback text-danger">
                  {{ $message }}
                </div>
              @enderror 
            </div>
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
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="6">{{ old('description', $product->description) }}</textarea>
            @error('description')
              <div class="invalid-feedback text-danger">
                {{ $message }}
              </div>
            @enderror 
          </div>
          <button type="submit" class="btn button-primary mt-2">Save</button>
        </form>
      </div>
      <div class="col-4 d-flex justify-content-center">
        <div class="rounded-4 border justify-content-center align-items-center d-flex product-img-preview-container">
          <img src="{{ asset('storage/images/products/' . $product->image) }}" class="rounded-4 product-img-preview" width="90%"/>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('myscript')
  <script>
    function previewImage() {
      const image = document.getElementById('image');
      const productImgPreview = document.querySelector('.product-img-preview');
      const oFReader = new FileReader();

      oFReader.readAsDataURL(image.files[0]);
      oFReader.onload = function(oFREvent) {
        productImgPreview.src = oFREvent.target.result;
      }
    }

    const inputRupiah = document.getElementById('price');
    inputRupiah.addEventListener('keyup', function(e)
    {
        inputRupiah.value = formatRupiah(this.value);
    });

    function formatRupiah(value)
    {
        let number_string = value.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return rupiah;
    }
  </script>
@endsection