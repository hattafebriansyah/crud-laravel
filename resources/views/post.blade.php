@extends('layouts.main')
@section('content')
    <h1> {{$title}}</h1>

    @foreach($posts as $post)

    <article>
        <h4><a href="/post/{{$post['slug']}}">{{$post['title']}}</a></h4>
        <h5>By : {{$post['penulis']}}</h5>
        <p>{{$post['body']}}</p>
    </article>
    @endforeach
@endsection