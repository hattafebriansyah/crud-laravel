@extends ('layouts.main')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 mt-5">

    @if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
      {{session ('error')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <main class="form-signin">
  <form action="register" method="post">
    @csrf
    <h1 class="h3 mb-3 fw-normal  text-center">Form Register</h1>

    <div class="form-floating">
      <input type="text" name="name" value= "{{old('name')}}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" required>
      <label for="floatingInput">Name</label>
      @error ('name')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror
    </div>

    <div class="form-floating mt-3">
      <input type="email" name="email" value= "{{old('email')}}"class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required>
      <label for="floatingInput">Email address</label>
      @error ('email')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror
    </div>

    <div class="form-floating mt-3">
      <input type="password" name = "password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
      <label for="floatingPassword">Password</label>
      @error ('password')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror
    </div>

    <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Register</button>
    
    <small >Already Registed? <a href="/register">Please Login</a></small>
  </form>
</main>
    </div>
</div>


@endsection
