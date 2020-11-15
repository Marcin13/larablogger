<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index($slug)
    {
        $posts = Post::published()
            ->whereHas('tags', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->latest('date')
            ->paginate(3); // mamy trzy wpisy,  teraz trzeba zrobić przejścia od podstron
        // compact: wyszukuje nazwy zmiennej i przesyła do widoku pod tą samą nazwą.
        return view('pages.posts', compact('posts'));
    }
    }
