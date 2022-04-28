@extends('dashboard.layouts.main')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Form Create Post</h1>
            <form action="/post/{{$edit['id']}}" method="post"  enctype="multipart/form-data">
                @csrf
                {{method_field('PUT')}}
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" value=" {{$edit['title']}}" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Title" required>
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                  </div>

                  <div class="mb-3">
                      <label>Post Category</label>
                      <select class="form-select" name="post_category_id">
                          <option selected disabled>Choose Post Category</option>
                          @foreach($postCategory as $data)
                          <option value="{{$data->id}}" @if($data->id == $edit->post_category_id) selected @endif >{{$data->name}}</option>
                          @endforeach
                      </select>
                  </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text"   value=" {{$edit['author']}}"name="author" class="form-control @error('author') is-invalid @enderror" id="author" placeholder="Author" required>
                    @error('author')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                  </div>

                  <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    @if($edit->image)
                    <img src="{{asset('storage/'.$edit->image)}}" class="img-preview img-fluid col-sm-5 d-block">
                    @else
                    <img class="img-preview img-fluid col-sm-5 d-block">
                    @endif
                    <input class="form-control" onChange="previewImage()" type="file" id="image" name="image">
                 </div>

                  <div class="mb-3">
                    <label for="body" class="form-label">Body</label>
                    <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" rows="3" required>{{$edit['body']}}</textarea>
                    @error('body')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <button type="submit" class="btn btn-warning w-100">Edit</button>
            </form>
        </div>
    </div>

    
    <!-- for preview image when upload -->
    <script>
        function previewImage(){
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = "block";

            const ofReader = new FileReader();
            ofReader.readAsDataURL(image.files[0]);

            ofReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }

        }
    </script>
@endsection