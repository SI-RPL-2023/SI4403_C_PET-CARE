<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PET-CARE</title>
  {{-- My CSS --}}
  <link rel="stylesheet" href="/css/style.css">
  
  {{-- Bootstrap --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  
  {{-- Icon --}}
  <link rel="icon" type="png" href="/images/web-icon.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <script src="https://kit.fontawesome.com/5173488c2b.js" crossorigin="anonymous"></script>
</head>
<body>
  {{-- Navbar --}}
  <nav class="navbar navbar-expand-lg fixed-top bg-white">
    <div class="container pb-2">
      <a class="navbar-brand" href="#"><img src="/images/logo.png" alt="Logo" width="200px"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav align-items-center ms-auto navbar-end">
          <a class="nav-link mx-2 {{ Request::is('/') ? 'active-link' : '' }}" href="/">Home</a>
          <a class="nav-link mx-2 {{ Request::is('vet*') ? 'active-link' : '' }}" href="/vet">Vet</a>
          <a class="nav-link mx-2 {{ Request::is('shop*') ? 'active-link' : '' }}" href="/shop">Shop</a>
          <a class="nav-link mx-2 {{ Request::is('articles*') ? 'active-link' : '' }}" href="/articles">Articles</a>
          @auth  
            <a class="nav-link mx-2 {{ Request::is('myorder*') ? 'active-link' : '' }}" href="/myorder">My Order</a>
            <a class="nav-link mx-2 {{ Request::is('myappointment*') ? 'active-link' : '' }}" href="/myappointment">My Appointment</a>
            <div class="nav-item dropdown">
              <a class="nav-link align-items-center d-flex {{ Request::is('myprofile') || Request::is('petprofile') ? 'active-link' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ auth()->user()->petOwner->name }} <img class="ms-2 rounded-circle nav-profile-picture" src="@if(auth()->user()->petOwner->image != null){{ asset('storage/images/petowner-pp/' . auth()->user()->petOwner->image) }}@else{{ "/images/no-pp.jpg" }}@endif" alt="{{ auth()->user()->petOwner->name }}">
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/myprofile"><i class="fa-solid fa-user me-2"></i> My Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item logout"><i class="fa-solid fa-right-from-bracket me-2"></i>Log Out</button>
                  </form>
                </li>
              </ul>
            </div>
          @else
            <a class="btn button-secondary px-4 ms-3" href="/login">Login</a>
          @endauth
        </div>
      </div>
    </div>
  </nav>

  {{-- Content --}}
  @yield('content')

  {{-- Footer --}}
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#f6faf9" fill-opacity="1" d="M0,224L48,208C96,192,192,160,288,170.7C384,181,480,235,576,234.7C672,235,768,181,864,186.7C960,192,1056,256,1152,266.7C1248,277,1344,235,1392,213.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
  </svg>
  <div class="container-fluid footer">
    <div class="container pb-5">
      <h3 class="text-center pt-5 pb-4 footer-text">Thank you so much for sharing your experience with us</h3>
      <form action="">
        <div class="row justify-content-center">
          <div class="col-md-6 d-flex">
            <input type="email" class="form-control py-2 rounded-0" id="exampleInputEmail1" placeholder="Your email address">
            <button type="submit" class="btn button-secondary px-3 py-2 rounded-0" style="width: 200px">Submit Now <i class="bi bi-chevron-right ms-2"></i></button>
          </div>
        </div>
      </form>
      <div class="row justify-content-between mt-5">
        <div class="col-3">
          <p class="fw-bold">Follow on social</p>
          <div class="d-flex">
            <a class="text-muted" href="" style="font-size: 40px"><i class="bi bi-facebook"></i></a>
            <a class="text-muted ms-4" href="" style="font-size: 40px"><i class="bi bi-instagram"></i></a>
          </div>
        </div>
        <div class="col-3 text-end">
          <p class="fw-bold">Health Care</p>
          <h5 style="color: #124C5F">(022)7687993</h5>
          <p class="text-muted">Jl. Telekomunikasi</p>
        </div>
      </div>
    </div>
  </div>

  {{-- My Script --}}
  @yield('myscript')


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>