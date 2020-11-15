<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Where to redirect users after the login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        /*Moje znalezisko, przekierowanie na poprzednia stone po zalogowaniu */
        session(['url.intended' => url()->previous()]);
        $this->redirectTo = session()->get('url.intended');
        //$this->middleware('verified')->only('show');
       // $this->middleware('verified')->only('store');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'post_id' => 'required|numeric|exists:posts,id',
            'content' => 'required|min:3'
        ]);
       // if (Auth::user()) {
        if (Auth::user()) {
            if ($request->user()->email_verified_at == null) {
                return redirect('/email/verify')->with('message-error', 'Please verify you email address first');
            }

            $comment = Comment::where('user_id', $request->user()->id)->orderBy('updated_at', 'desc')->first();

            if ($comment and $comment->content == $data['content']) {
                return back()->with('message-error', 'Your just add same comment content second ego!');
            } else {


                Comment::create(Arr::add($data, 'user_id', $request->user()->id));
                return back()->with('message', 'Your comment has been added!');
            }
    }
    {

           return redirect('/account/login')->with('message-error', 'Please login to add comments to the post!');

        }
    }

}
