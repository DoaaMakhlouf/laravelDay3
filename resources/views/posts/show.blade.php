@extends('layouts.app')


@section('title')
Show Post
@endsection

@section('main')
<div class="card mt-5">
    <div class="card-header">
        Post Info
    </div>
    <div class="card-body">
        <h5 class="card-title">Title: {{$post['title']}}</h5>
        <p class="card-text">Body: {{$post['body']}}</p>
        <p class="card-text">Created at: {{ \Carbon\Carbon::parse($post->created_at)->format('M d, Y h:i A') }}</p>
        <p class="card-text">Shown at: {{ $post->shown_at }}</p>
        <img src="{{ asset('images/posts/'.$post['image']) }}" width="100" height="100">
    </div>
</div>
@endsection