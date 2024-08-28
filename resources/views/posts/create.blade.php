@extends('layouts.app')

@section('title')
Create Post
@endsection

@section('main')
<form action='{{route('posts.store')}}' method='POST' enctype='multipart/form-data'>
    @csrf
    <div class='form-group mt-5'>
        <label for='title'>Title</label>
        <input type='text' class='form-control' id='title' name='title' value='{{old('title')}}'>
        @error('title')
            <div class='alert alert-danger'>{{ $message }}</div>
        @enderror
    </div>
    <div class='form-group mt-3'>
        <label for='body'>Body</label>
        <textarea class='form-control' id='body' name='body' value='{{old('body')}}'></textarea>
        @error('body')
            <div class='alert alert-danger'>{{ $message }}</div>
        @enderror
    </div>
    <div class='form-group mt-3'>
        <label for='image'>Upload Image</label>
        <input type='file' name='image'>
        @error('image')
            <div class='alert alert-danger'>{{ $message }}</div>
        @enderror
    </div>
    <div class='form-group mb-3'>
        <label for='posted by' class='form-label'> Post Creator</label>
        <select id='posted by' class='form-select' name='user_id'>
            <option value="null" disabled>Select Creator</option>
            @foreach ($users as $user)
                <option value='{{$user['id']}}' selected>{{$user['name']}}</option>
            @endforeach
        </select>
        @error('user_id')
            <div class='alert alert-danger'>{{ $message }}</div>
        @enderror
    </div>

    <button type='submit' class='btn btn-success mt-3'>Create</button>
</form>
@endsection