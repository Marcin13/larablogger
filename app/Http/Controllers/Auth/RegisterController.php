<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }
    /*Własny wykop z stackoverflow*/
    protected function redirectTo(){
        if(session()->get("redirect_after_email_verification")){
            return session()->get("redirect_after_email_verification");
        }

        return $this->redirectTo;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * The user has been registered.
     *
     * @param Request $request
     * @param mixed $user
     * @return void
     */
    protected function registered(Request $request, $user)
    {
        //
        session()->flash('message', "Hi {$user->name}, you've been registered and logged in!");
        /*Działa*/
        // $when = now()->addMinutes(2);
         // Mail::to($user->email)->later($when, new UserRegistered($user));
        /*Działa*/

        /*Działa*/
        $emailJob = (new      SendEmail($user))->delay(Carbon::now()->addMinutes(2));
        dispatch($emailJob);
        /*Działa */
        /*This should typically only be used for jobs that take about a second, such as sending an email:*/
        //SendNotification::dispatchAfterResponse();
        //now()->addSeconds(5);
    }
}
