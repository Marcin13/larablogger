<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    //
    protected function validator($data)
    {
        $messages = array(
            'required' => 'The search field is required.',
            'min' => 'The search must be minimum :min chars.',
            'max' => 'The search must be maximum :max chars.',
        );
        return Validator::make($data, [
            'q' => ['required', 'min:3', 'max:255'],
            //'q' => ['nullable','min:3', 'max:255'],
        ],
           $messages // musi tu byc by wyświetlać komunikaty
        )->validate();
    }

    public function index(Request $request)
    {
        $q = $this->validator($request->all());
        $q = implode(" ", $q);
        //dd($q);
        $posts = Post::published()
            ->where('title', 'like', "%$q%")
            ->latest('id')
            ->paginate(3);
        $posts->appends(['q' => $q]); // dodaje search do paginacji!!!
        return view('pages.posts', compact('posts'));
    }
}
