@extends('layouts.app')

@section('title')
All posts
@endsection

@section('main')
@if(session('success'))
    <div class="alert alert-success">{{ session("success") }}</div>
@endif
<a href="{{route('posts.create')}}" class="btn btn-success mt-5">Create Post</a>
<a href="{{route('posts.index')}}" class="btn btn-warning mt-5">Show Deleted Posts</a>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Body</th>
            <th>Created At</th>
            <th>Shown At</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->body}}</td>
                <td>{{ \Carbon\Carbon::parse($post->created_at)->format('M d, Y h:i A') }}</td>
                <td>{{ $post->shown_at }}</td>
                <td>
                    <img src="{{ asset('images/posts/' . $post->image) }}" width="70" height="70">
                </td>
                <td>
                    <a href="{{route('posts.show', $post)}}" class="btn btn-info">Show</a>
                    <a href="{{route('posts.edit', $post)}}" class="btn btn-primary">Edit</a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#idModal{{$post->id}}">
                        Delete
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="idModal{{$post->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Post</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this post?</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{route('posts.destroy', $post)}}" method="post"
                                        id="delete-form-{{$post->id}}">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-primary"
                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{$post->id}}').submit();">Yes</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $posts->links() }}
@endsection

@section('deletedPosts')
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Body</th>
            <th>Created At</th>
            <th>Deleted At</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($deletedPosts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->body}}</td>
                <td>{{ \Carbon\Carbon::parse($post->created_at)->format('M d, Y h:i A') }}</td>
                <td>{{ \Carbon\Carbon::parse($post->deleted_at)->format('M d, Y h:i A') }}</td>
                <td>
                    <img src="{{ asset('images/posts/' . $post->image) }}" width="70" height="70">
                </td>
                <td>
                    <a href="{{route('posts.restore', $post->id)}}" class="btn btn-warning">Restore</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $deletedPosts->links() }}
@endsection