<?php

namespace App\Http\Controllers;

use App\Mail\message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //
    protected function validator($data)
    {
        $messages = [
            'g-recaptcha-response.required' => 'You must check the reCAPTCHA.',
            'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin.',
        ];
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:355'],
            'g-recaptcha-response' => 'required|captcha'
        ], $messages) //musi tu być do wyświetlania wiadomości
             ->validate();
    }

    public function show()
    {  /*własna metoda jak uzupełnić email jak użytkownik jest zalogowany*/
        Auth::user() ? $user_email = Auth::user()->email : $user_email = '';
           // dd($user_email);
        return view('pages.contact')->with(['user_email' => $user_email]);
        // return view('pages.contact');
    }

    public function send(Request $request)
    {
        $data = $this->validator($request->all());
        Mail::to(config('mail.admin.address'))->send(new Message($data));
        return back()->with('message', 'Your email has been sent!');
    }
}
