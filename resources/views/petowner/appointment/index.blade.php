@extends('layouts.main')

@section('content')
  <div class="container vet spacing">
    <div class="row justify-content-between gx-5">
      <div class="col-6">
        <div class="underline position-relative d-flex">
          <h2>Vet</h2>
        </div>
      </div>
    </div>
    <div class="row g-4 mt-2">
      @if ($vets->count())
        @foreach ($vets as $vet)    
          <div class="col-3">
            <div class="card card-product-vet vet-card">
              <span class="vet-id d-none">{{ $vet->vet_id }}</span>
              <div class="d-flex p-1 card-img">
                <img src="{{ asset('storage/images/vets/' . $vet->image) }}" class="product-img m-auto rounded-2 object-fit-cover" alt="{{ $vet->name }}" style="height: 240px" />
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
      @else
        <div class="d-flex align-items-center justify-content-center" style="height: 400px">
          <h4 class="text-muted not-added">No vet has been added</h4>
        </div>
      @endif
    </div>
  </div>
@endsection

@section('myscript')
  <script>
    const vetCards = document.querySelectorAll('.vet-card');

    vetCards.forEach((vetCard) => {
      vetCard.addEventListener('click', function() {
        const vetId = this.querySelector('.vet-id').textContent;
        document.location.href = `vet/make-appointment/${vetId}`;
      })
    })
  </script>
@endsection