@extends('dashboard.layouts.main')

@section('content')
    <div class="row justify-content-center">
        @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="col-md-8">
            <h1>Form Edit Post Category</h1>
            <form action="/post-category/{{ $data->id }}" method="post">
                @csrf
                {{ method_field('PUT') }}
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" value="{{ $data['name'] }}" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="name" required>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3" required>{{ $data['description'] }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <button type="submit" class="btn btn-warning">Update</button>
            </form>
        </div>
    </div>
@endsection