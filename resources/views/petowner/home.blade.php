@extends('layouts.main')

@section('content')
  {{-- Banner --}}
  <div class="container-fluid hero">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <h1 class="hero-title">Taking care <br>for your Smart Pet!</h1>
          <a class="btn button-secondary px-3 py-2 mt-3 rounded-1" href="">Explore More</a>
        </div>
        <div class="col-md-6 text-end">
          <img class="hero-img" src="images/hero-img.png" alt="">
        </div>
      </div>  
    </div>
  </div> 

  {{-- Services --}}
  <div class="container my-5">
    <div class="row justify-content-between">
      <div class="col-md-2 rounded-4 text-center shadow-sm service">
        <div class="pt-5" style="height: 70%">
          <img src="images/services/grooming.png" alt="Grooming" height="75px">
        </div>
        <div class="pb-5">
          <span>Grooming</span>
        </div>
      </div>
      <div class="col-md-2 rounded-4 text-center shadow-sm service">
        <div class="pt-5" style="height: 70%">
          <img src="images/services/healthcare.png" alt="Healthcare">
        </div>
        <div class="pb-5">
          <span>Healthcare</span>
        </div>
      </div>
      <div class="col-md-2 rounded-4 text-center shadow-sm service">
        <div class="pt-5" style="height: 70%">
          <img src="images/services/daycare.png" alt="Daycare">
        </div>
        <div class="pb-5">
          <span>Daycare</span>
        </div>
      </div>
      <div class="col-md-2 rounded-4 text-center shadow-sm service">
        <div class="pt-5" style="height: 70%">
          <img src="images/services/training.png" alt="Training">
        </div>
        <div class="pb-5">
          <span>Training</span>
        </div>
      </div>
      <div class="col-md-2 rounded-4 text-center shadow-sm service">
        <div class="pt-5" style="height: 70%">
          <img src="images/services/hyginic-care.png" alt="Hyginic Care">
        </div>
        <div class="pb-5">
          <span>Hyginic Care</span>
        </div>
      </div>
    </div>
  </div>

  {{-- New Foods and Stuffs --}}
  <div class="container my-5 foods-stuffs">
    <div class="underline position-relative">
      <h2>New Foods and Stuffs</h2>
    </div>
    <div class="row g-4 mt-3">
      @if ($newProducts->count())
        @foreach ($newProducts as $product)    
          <div class="col-3 mb-4">
            <div class="card card-product-vet card-product" data-bs-toggle="modal" data-bs-target="#productDetail">
              <div class="d-flex p-1 card-img">
                <img src="{{ asset('storage/images/products/' . $product->image) }}" class="product-img m-auto" alt="..." />
              </div>
              <div class="card-body d-flex align-items-center bg-light text-break rounded rounded-top-0 mt-3">
                <div>
                  <span class="text-muted product-category">{{ $product->category->name }}</span>
                  <h5 class="product-name">{{ $product->name }}{{ $product->weight == null ? '' : ' | ' . $product->weight }}</h5>
                  <span class="my-2 d-block product-stock">Stock: {{ $product->stock }}</span>
                  <h5 class="fw-bold product-price">@currency($product->price)</h5>
                  <span class="product-slug d-none">{{ $product->slug }}</span>
                  <span class="product-description d-none">{{ $product->description  }}</span>
                </div>
              </div>
            </div>
          </div>
        @endforeach
        <div class="col-12 d-flex justify-content-center mt-2">
          <a href="/shop" class="btn button-secondary px-3 py-2 mt-3 rounded-1">Explore More</a>
        </div>
      @else
        <div class="d-flex align-items-center justify-content-center" style="height: 400px">
          <h4 class="text-muted not-added">No product has been added</h4>
        </div>
      @endif
    </div>
  </div>

  {{-- New Article --}}
  <div class="container my-5 article">
    <div class="underline position-relative">
      <h2>New Article</h2>
    </div>
    <div class="row align-items-center" style="margin-top: 35px">
      @if ($newArticle)
        <div class="col-6">
          <h4 class="mb-4 article-title">{{ $newArticle->title }}</h4>
          <p class="text-muted">{{ $newArticle->excerpt }}</p>
          <a href="/articles/{{ $newArticle->slug }}" class="btn button-secondary px-3 py-2 mt-3 rounded-1">Read More</a>
        </div>
        <div class="col-6 text-end">
          <img src="{{ asset('storage/images/articles/' . $newArticle->image) }}" class="img-thumbnail rounded-4 big-img" alt="{{ $newArticle->image }}">
        </div>
      @else
        <div class="d-flex align-items-center justify-content-center" style="height: 400px">
          <h4 class="text-muted not-added">No article has been added</h4>
        </div>
      @endif
    </div>
  </div>

  {{-- Vet --}}
  <div class="container mt-5 vet">
    <div class="underline position-relative">
      <h2>Vet</h2>
    </div>
    <div class="row g-4 mt-3">
      @if ($vets->count())
        @foreach ($vets as $vet)    
          <div class="col-3">
            <div class="card card-product-vet vet-card">
              <span class="vet-id d-none">{{ $vet->vet_id }}</span>
              <div class="d-flex p-1 card-img">
                <img src="{{ asset('storage/images/vets/' . $vet->image) }}" class="product-img m-auto rounded-2 object-fit-cover" alt="{{ $vet->name }}" style="height: 250px" />
              </div>
              <div class="card-body d-flex align-items-center bg-light text-break rounded rounded-top-0">
                <div class="text-center w-100">
                  <span class="text-muted product-category">{{ $vet->phone }}</span>
                  <h5 class="product-name">{{ $vet->user->email }}</h5>
                  <h5 class="fw-bold product-price">{{ $vet->name }}</h5>
                </div>
              </div>
            </div>
          </div>
        @endforeach
        <div class="col-12 d-flex justify-content-center mt-2">
          <a href="/vet" class="btn button-secondary px-3 py-2 mt-3 rounded-1">Explore More</a>
        </div>
      @else
        <div class="d-flex align-items-center justify-content-center" style="height: 400px">
          <h4 class="text-muted not-added">No vet has been added</h4>
        </div>
      @endif
    </div>
  </div>

  {{-- Modal --}}
  <div class="modal fade" id="productDetail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content"></div>
    </div>
  </div>
@endsection

@section('myscript')
  <script>
    const products = document.querySelectorAll('.card-product');
    const vetCards = document.querySelectorAll('.vet-card');

    vetCards.forEach((vetCard) => {
      vetCard.addEventListener('click', function() {
        const vetId = this.querySelector('.vet-id').textContent;
        document.location.href = `vet/make-appointment/${vetId}`;
      })
    })

    products.forEach((product) => {
      product.addEventListener('click', function() {
        const dataProduct = getProduct(this);
        updateModal(dataProduct);
      });
    });

    function getProduct(target) {
      return {
        image: target.querySelector('.product-img').getAttribute('src'),
        category: target.querySelector('.product-category').textContent,
        name: target.querySelector('.product-name').textContent,
        stock: target.querySelector('.product-stock').textContent,
        price: target.querySelector('.product-price').textContent,
        slug: target.querySelector('.product-slug').textContent,
        description: target.querySelector('.product-description').textContent
      };
    };

    function updateModal(dataProduct) {
      const modalContent = document.querySelector('.modal-content');
      modalContent.innerHTML = `
      <form action="/shop/cart/${dataProduct.slug}/add" method="post">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="productDetail">Product Detail</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal""></button>
        </div>
        <div class="modal-body">
          <div class="row align-items-center">
            <div class="col-5 d-flex justify-content-center">
              <img src="${dataProduct.image}" class="modal-product-img m-auto" alt="..." />
            </div>
            <div class="col-7">
              <span class="text-muted">${dataProduct.category}</span>
              <h5>${dataProduct.name}</h5>
              <span class="d-block my-2 product-stock">${dataProduct.stock}</span>
              <h5 class="fw-bold">${dataProduct.price}</h5>
              <input class="form-control my-4" type="number" value="1" min="1" max="99" id="quantity" name="quantity" style="width: 70px" />
              <h5>Description</h5>
              <div class="product-desc-container">
                <span>${dataProduct.description}</span>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn button-secondary"><i class="bi bi-bag-plus"></i></button>
        </div>
      </form>`;
    };
  </script>
@endsection