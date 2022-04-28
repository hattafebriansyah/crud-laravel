@extends('dashboard.layouts.main')

@section('content')
    <div class="row justify-content-center mt-4">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show col-md-8" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="col-md-8">
            <a href="/post-category/create" class="btn btn-success">Add Post Category</a>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $postCategory)
               
                <tr>
                    <th scope="row">{{$loop -> iteration}}</th>
                    <td>{{ $postCategory['name'] }}</td>
                    <td>{{ $postCategory['description'] }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="/post-category/{{ $postCategory->id }}/edit" type="button" class="btn btn-warning">Edit</a>
                            <form action="/post-category/{{ $postCategory['id'] }}" method="post">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection