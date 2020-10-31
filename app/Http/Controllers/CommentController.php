<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function store(Request $request)
    {
        $data = $request->validate([
            'post_id' => 'required|numeric|exists:posts,id',
            'content' => 'required|min:3'
        ]);
        if (Auth::user()) {
            $comment = Comment::where('user_id', $request->user()->id)->orderBy('updated_at', 'desc')->first();

            if ($comment and $comment->content == $data['content']) {
                return back()->with('message-error', 'Your just add same comment content second ego!');
            } else {


                Comment::create(Arr::add($data, 'user_id', $request->user()->id));
                return back()->with('message', 'Your comment has been added!');
            }
    }else{
            return redirect('/account/login')->with('message-error', 'You have to login first to add comments to post!');
        }
    }

}
