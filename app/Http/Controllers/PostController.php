<?php

namespace App\Http\Controllers;

use App\Models\Post;


class PostController extends Controller
{
     // dodając  ta linked dostęp do wpisów maja tylko osoby z zweryfikowanym email
    /*
     public function __construct()
       {
           $this->middleware('verified')->only('show');
       }
*/
    //
    public function index()
    {
       // $posts = Post::latest('date')->paginate(3);
       //$posts = Post::published()->oldest('date')->paginate(3);
        $posts = Post::published()->latest('date')->paginate(3);
        return view('pages.posts', compact('posts'));
    }
    public function show(Post $post){
       // $post = Post::findOrFail($post);
        return view('pages.post', compact('post'));
    }
}
