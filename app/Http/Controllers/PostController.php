<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index(Request $request)
    {
        $posts = Post::latest('date')->paginate(3);
        return view('pages.posts', compact('posts'));
    }
    public function show(Post $post){
       // $post = Post::findOrFail($post);
        return view('pages.post', compact('post'));
    }
}
