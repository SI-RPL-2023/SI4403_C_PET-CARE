@extends('layouts.admin')

@section('content')
  <div class="container mb-4 dashboard-title">
    <div class="row">
      <div class="col-6">
        <div class="underline position-relative">
          <h3 class="m-0 mb-5">Vets</h3>
        </div>
      </div>
      <div class="col-6 text-end">
        <a href="vets/create" class="btn button-secondary">Add new vet</a>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="container mt-3">
          @if (session()->has('success'))
            <div class='alert alert-success alert-dismissible' role='alert'>
              <span>{{ session('success') }}</span>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          @if ($vets->count())   
            <div class="table-responsive" style="height: 31rem">
              <table class="table table-hover">
                <thead class="bg-white position-sticky top-0">
                  <tr>
                    <th scope="col">Vet ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Location</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($vets as $vet)    
                    <tr>
                      <td scope="row">{{ $vet->vet_id }}</td>
                      <td>Drh. {{ $vet->name }}</td>
                      <td>{{ $vet->user->email }}</td>
                      <td>{{ $vet->phone }}</td>
                      <td>{{ $vet->location }}</td>
                      <td>
                        <form action="/dashboard/vets/{{ $vet->vet_id }}" method="post" class="d-inline">
                          @method('delete')
                          @csrf
                          <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><i class="bi bi-eraser"></i></button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="d-flex align-items-center justify-content-center" style="height: 450px">
              <h4 class="text-muted">No vet has been added</h4>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection