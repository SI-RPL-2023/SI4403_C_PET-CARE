@extends('layouts.main')

@section('content')
  <div class="container foods-stuffs spacing">
    <div class="row justify-content-between gx-5">
      <div class="col-6">
        <div class="underline position-relative">
          <h2>Foods and Stuffs</h2>
        </div>
      </div>
      @auth
        <div class="col-4 d-flex justify-content-end align-items-start">
          <a href="/shop/cart" class="btn button-secondary ms-2 position-relative"><i class="bi bi-bag"></i><span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger count-cart">{{ $carts->sum('quantity') }}</span></a>
        </div>
      @endauth
    </div>
    <div class="row g-4 mt-2">
      @if ($products->count())
        @foreach ($products as $product)
          @if ($product->stock == 0)
            @continue
          @endif  
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
    const countCart = document.querySelector('.count-cart');
    const search = document.querySelector('.search');

    if(countCart != null) {
      if(countCart.textContent == 0) {
        countCart.classList.add('d-none');
      }
    }

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