@extends('layouts.main')

@section('content')
  <div class="container article spacing">
    <div class="row align-items-center mt-4">
      <div class="col-6">
        <span class="fs-5 text-muted">{{ $article->created_at->diffForHumans() }}</span>
        <h1 class="mt-1 mb-3 article-title">{{ $article->title }}</h1>
        <div class="d-flex align-items-center">
          <img src="{{ asset('storage/images/vets/' . $article->vet->image) }}" class="rounded-circle me-2 article-profile-picture" alt="">
          <div class="ms-2">
            <span class="d-block">Drh. {{ $article->vet->name }}</span>
            <span class="text-muted"><i class="fa-solid fa-stethoscope me-2"></i>Vet</span>
          </div>
        </div>
      </div>
      <div class="col-6 text-end border-bottom-3">
        <img src="{{ asset('storage/images/articles/' . $article->image) }}" class="img-thumbnail rounded-4 big-img" alt="{{ $article->image }}" style="width: 90%">
      </div>
      <div class="col-12 mt-5 border-5">
        <p class="card-text text-muted mt-3">{!! $article->body !!}</p>
        <a href="/articles" class="btn button-secondary mt-3">Back to articles</a>
      </div>
    </div>
  </div>  
@endsection