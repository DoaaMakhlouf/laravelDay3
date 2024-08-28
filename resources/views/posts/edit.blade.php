@extends("layouts.app")

@section("title")
Edit post
@endsection

@section("main")
<form action="{{route('posts.update', $post)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="mb-3">
        <label for="TextInput" class="form-label"> Title</label>
        <input type="text" id="TextInput" class="form-control" value="{{$post->title}}" name="title">
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="floatingTextarea2">Body </label>
        <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                style="height: 100px" name="body">{{$post->body}}</textarea>
            @error('body')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group mt-3">
        <label for="image">Upload Image</label>
        <input type="file" name="image"  >
    </div>
    <div class="mb-3">
        <label for="Select" class="form-label"> Post Creator</label>
        <select id="Select" class="form-select" name="user_id">
            <!-- <option value="{{$post->user_id}}"> -->
                @foreach ($users as $user)
                    <option value="{{$post->user_id}}" {{($user->id == $post->user_id)?'selected':''}}>
                    {{$user->name}}</option>
                @endforeach
            <!-- </option> -->
        </select>
        @error('user_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <input type="submit" class="btn btn-primary" value="Update">
</form>
@endsection