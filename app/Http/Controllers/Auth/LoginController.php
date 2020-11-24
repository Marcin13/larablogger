<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after the login.
     *
     * @var string
     */
       protected $redirectTo = RouteServiceProvider::HOME;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*Moje znalezisko, przekierowanie na poprzednia stone po zalogowaniu */
        session(['url.intended' => url()->previous()]);
        $this->redirectTo = session()->get('url.intended');
        $this->middleware('guest')->except('logout');
    }
    /**
     * The user has been authenticated.
     *
     *@param Request $request
     * @param  mixed  $user
     * @return void
     */
    protected function authenticated(Request $request, $user)
    {
        //
        session()->flash('message', "Hi {$user->name}, you've been logged in!");

    }

    /**
     * The user has logged out of the application.
     *
     * @return void
     */
    protected function loggedOut()
    {
        //
        session()->flash('message',"You have been successfully logged out!!!");
    }

}
