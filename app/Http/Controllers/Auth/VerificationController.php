<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
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
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
    /*Własny wykop z stackoverflow*/
    protected function redirectTo(){
        if(session()->get("redirect_after_email_verification")){
            return session()->get("redirect_after_email_verification");
        }

        return $this->redirectTo;
    }


    /**
     * The user has been verified.
     *
     * @param Request $request
     * @return void
     */
    protected function verified(Request $request)
    {
        //
        session()->flash('message', "Hi, your email has been verify!");

    }
}
