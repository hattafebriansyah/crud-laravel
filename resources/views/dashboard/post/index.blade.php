@extends ('dashboard.layouts.main')

@section('content')
<div class="row justify-content-center mt-4">
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show col-md-8" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-success alert-dismissible fade show col-md-8" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="col-md-8">
        <a href="/post/create" class="btn btn-success">Add New Post</a>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="/post">
                    <div class="input-group mb-3 mt-4">
                        <input type="text" class="form-control" placeholder="Search" name="search" value = "{{request('search')}}" >
                        <button class="btn btn-primary" type="submit" >Search</button>
                    </div> 
                </form>
            </div>
        </div>
        
       

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Post Category</th>
                        <th scope="col">Author</th>
                        <th scope="col">Body</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody>
                @foreach ($data as $post)
                    <tr>
                    <td>{{$loop -> iteration}}</td>
                    <td><img src="{{asset('storage/'.$post->image)}}" width="100px" height="100px" ></td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->postCategory->name}}</td>
                    <td>{{$post->author}}</td>
                    <td>{{$post->body}}</td>
                    <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="/post/{{ $post->id }}/edit" type="button" class="btn btn-warning">Edit</a>
                            <form action="/post/{{ $post['id'] }}" method="post">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger" onClick='confirm("Are You Sure??")'>Delete</button>
                            </form>
                            
                        </div>
                    </td>
                    
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{$data->links()}}
        </div>
</div>

@endsection