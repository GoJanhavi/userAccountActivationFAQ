<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyAndActivate;

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

    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect('/login')->with('message', 'We sent you an activation code. Check your email and click on the link to verify.');
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_activation_token' => str_random(58),
        ]);

        Mail::to($user->email)->send(new VerifyAndActivate($user));

        return $user;
    }

    protected function userActivationViaEmail($token){

        $userActivation = User::where('user_activation_token', $token)->first();;

        if(isset($userActivation) ){
            $user = $userActivation;
            if(!$user->email_verified_at) {
                $user->email_verified_at = date("F j, Y, g:i a");
                $user->save();
                $status = "Email is successfully verified. You can access your account by logging in.";
            }else{
                $status = " Your Email is already verified. You can access your account by logging in";
            }
        }else{
            return redirect('/login')->with('error', "Unidentified account! Please activate your account using link sent to your email.");
        }

        return redirect('/login')->with('message', $status);
    }
}
