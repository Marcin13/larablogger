<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($name){
       $user =  User::where('name',$name)->firstOrFail();
        // $user = User::Where('name',$name)->first();
        return view('user.profile', compact('user'));
    }
}
