<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Log;


class PostController extends Controller
{
     // dodając  ta linked dostęp do wpisów maja tylko osoby z zweryfikowanym email
    /*
     public function __construct()
       {
           $this->middleware('verified')->only('show');
       }
*/
    public function index()
    {
        $posts = Post::published()->with(['tags','author'])->latest('id')->paginate(3);
       //Log::info('Test info');
      // Log::error('Test error');
       // $posts = Post::published()->latest('date')->paginate(3);
        return view('pages.posts', compact('posts'));
    }
    public function show($slug){
        //$post = Post::published()->with(['tags','author'])->oldest('date')->whereSlug($slug)->get();
        $post = Post::published()->with(['tags','author','comments'])->whereSlug($slug)->firstOrFail();

        /*Wszystko działa jak powinno*/
        $post['previous'] = $post->previous('slug'); // next i previous zdefiniowane na modelu
        $post['next'] = $post->next('slug');

       return view('pages.post', compact('post'));
    }
}
