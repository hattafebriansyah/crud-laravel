@extends ('layouts.main')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 mt-5">
    @if(session()->has('success'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      {{session ('success')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{session ('error')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <main class="form-signin text-center">
  <form action="/login" method="post">
    @csrf
  
    <h1 class="h3 mb-3 fw-normal">Form Login</h1>

    <div class="form-floating">
      <input type="email" name = 'email' class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" required>
      <label for="floatingInput">Email address</label>
      @error ('email')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror
    </div>
    <div class="form-floating mt-3">
      <input type="password" name = 'password' class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password" required>
      <label for="floatingPassword">Password</label>
      @error ('password')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror
    </div>

    <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Login</button>
    <br><small >Not Registed? <a href="/register">Register Now</a></small>
  </form>
</main>
    </div>
</div>


@endsection
