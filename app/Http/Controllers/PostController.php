<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(3);
        $deletedPosts = Post::onlyTrashed()->paginate(3);
        return view('posts.index', compact('posts','deletedPosts'));
    }

    /**
     * Display a listing of the deleted resource.
     */
    // public function indexdeleted()
    // {
    //     $deletedPosts = Post::onlyTrashed()->get();
    //     dd($deletedPosts);
    //     // return view('posts.indexdeleted', compact('deletedPosts'));  
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('posts.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        // validating data
        $validate = $request->validate(
            [
                'title' => 'required|min:3|unique:posts',
                'body' => 'required|min:10',
                'user_id' => 'unique:users',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]
        );

        // storing data
        $image_path = $post->image;
        $data = request()->all();
        if (request()->hasFile('image')) {
            $image = request()->file('image');
            $image_path = $image->store('images', 'posts_images');
        }
        $data['image'] = $image_path;
        $post->update($data);
        return to_route('posts.index', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->update(['shown_at' => now()]);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // $user = User::find($post->user_id);
        $users = User::all();
        return view('posts.edit', compact('post', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // validating data
        $validate = $request->validate(
            [
                'title' => ["required", Rule::unique('posts')->ignore($post)],
                'body' => 'required|min:10',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]
        );

        // updating data
        $image_path = $post->image;
        $data = request()->all();
        if (request()->hasFile('image')) {
            $image = request()->file('image');
            $image_path = $image->store('images', 'posts_images');
        }
        $data['image'] = $image_path;
        $post->update($data);
        return to_route('posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return to_route('posts.index')->with('success', 'Post deleted successfully');
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        $deletedPost = Post::onlyTrashed()->find($id);
        $deletedPost->restore();
        return to_route('posts.index')->with('success', 'Post restored successfully');
    }

}
