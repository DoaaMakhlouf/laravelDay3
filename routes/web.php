<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Post;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', PostController::class);
// Route::get('posts/indexdeleted', [PostController::class, 'indexdeleted'])->name('posts.indexdeleted');
Route::get('posts/restore/{id}', [PostController::class,'restore'])->name('posts.restore');
// Route::get('posts/indexdeleted', dd('found'))->name('posts.indexdeleted');


// Route::get('posts/indexdeleted', function () {
//     $deletedPosts = Post::onlyTrashed()->get();
//     dd($deletedPosts);
//     return view('posts.indexdeleted', compact('deletedPosts'));
// })->name('posts.indexdeleted');



Route::get('posts/indexdeleted', function () {
    $deletedPosts = Post::onlyTrashed()->get();
    // Just for debugging: Uncomment the line below to see the results
    // dd($deletedPosts);
    return view('posts.indexdeleted', compact('deletedPosts'));
})->name('posts.indexdeleted');

    

    



