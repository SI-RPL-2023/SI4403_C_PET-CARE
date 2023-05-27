<div class="shadow bg-white rounded-4 p-4 text-center position-relative d-flex align-items-center justify-content-center vet-id-card">
  <div>
    <img src="{{ asset('storage/images/vets/' . auth()->user()->vet->image) }}" class="rounded-circle img-fluid pp" alt="">
    <h3 class="my-2">Drh. {{ auth()->user()->vet->name }}</h3>
    <span class="d-block">{{ auth()->user()->vet->phone }}</span>
    <span>{{ auth()->user()->email }}</span>
  </div>
</div>