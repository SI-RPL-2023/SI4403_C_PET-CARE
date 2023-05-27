@extends('layouts.vet')

@section('content')
  <div class="row justify-content-between">
    <div class="col-6">
      <div class="underline position-relative d-flex justify-content-between my-article">
        <h3>My Articles</h3>
      </div>
    </div>
    <div class="col-6 text-end">
      <a href="/vetdashboard/articles/create" class="btn button-secondary">Create New Article</a>
    </div>
  </div>
  <div class="table-responsive mt-4 px-4 article-container">
    @if (session()->has('success'))
    <div class="row">
      <div class="col-12">
        <div class='alert alert-success alert-dismissible' role='alert'>
          <span>{{ session('success') }}</span>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    </div>
    @endif
    @if ($articles->count())    
      <table class="table table-hover">
        <thead class="bg-white position-sticky top-0">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Title</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody> 
          @foreach ($articles as $article)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $article->title }}</td>
              <td>
                <form action="/vetdashboard/articles/{{ $article->slug }}" method="post" class="d-inline">
                  @method('delete')
                  @csrf
                  <button class="badge bg-danger border-0"><i class="fa-solid fa-eraser"></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="d-flex align-items-center justify-content-center h-100 w-100">
        <h4 class="text-muted">You haven't created an article yet</h4>
      </div>
    @endif
  </div>
@endsection

@section('vet-card')
  @include('partials.vet-card')
@endsection