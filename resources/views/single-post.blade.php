@extends('layouts.main')

@section('content')
    <h1> {{$title}}</h1>

    <article>
        <h4><a href="/post/{{$post['slug']}}">{{$post['title']}}</a></h4>
        <h5>By : {{$post['penulis']}}</h5>
        <p>{{$post['body']}}</p>
    </article>

    <a href="/post/">Back to Post</a> 
@endsection