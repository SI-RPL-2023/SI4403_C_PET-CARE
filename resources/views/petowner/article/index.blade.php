@extends('layouts.main')

@section('content')
  <div class="container article spacing">
    <div class="row justify-content-between gx-5">
      <div class="col-6">
        <div class="underline position-relative">
          <h2>Articles</h2>
        </div>
      </div>
    </div>
    @if ($articles->count())    
      <div class="row align-items-center mt-4">
        <div class="col-6">
          <h4 class="mb-4 article-title d-flex align-items-center">{{ $articles[0]->title }}</h4>
          <p class="text-muted">{{ $articles[0]->excerpt }}</p>
          <a href="/articles/{{ $articles[0]->slug }}" class="btn button-secondary px-3 py-2 mt-3 rounded-1">Read More</a>
        </div>
        <div class="col-6 text-end">
          <img src="{{ asset('storage/images/articles/' . $articles[0]->image) }}" class="img-thumbnail rounded-4 big-img" alt="{{  $articles[0]->image }}" style="width: 90%">
        </div>
      </div>
      <div class="row g-5" style="margin-top: 35px">
        @foreach ($articles->skip(1) as $article)    
          <div class="col-md-4">
            <div class="card border-0">
              <div class="card-img-top p-2">
                <img src="{{ asset('storage/images/articles/' . $article->image) }}" class="rounded-3 img-fluid article-img" alt="{{ $article->image }}">
              </div>
              <div class="card-body mt-2 h-100">
                <h5 class="article-title d-flex align-items-center fs-5">{{ Str::limit($article->title, 70) }}</h5>
                <p class="card-text text-muted mt-3">{{ $article->excerpt }}</p>
                <a href="/articles/{{ $article->slug }}" class="btn button-secondary px-3 py-2 mt-3 rounded-1">Read More</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="d-flex align-items-center justify-content-center" style="height: 400px">
        <h4 class="text-muted not-added">Article has not been added</h4>
      </div>
    @endif
  </div>
@endsection