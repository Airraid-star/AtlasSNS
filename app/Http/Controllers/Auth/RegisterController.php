<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

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

    public function register(Request $request){
        if($request->isMethod('post')){

            $request->validate([
                'username'=>['required','min:2','max:12'],
                'mail'=>['required','min:5','max:40','unique:users,mail','email'],
                'password'=>['required','digits_between:8,20','confirmed']
            ]);

            //[_confirmed]とついた物にバリテーションで[confirmed]をつけると確認入力となる
            //'digits_between:8,20'は８桁から２０桁までの数字の意味

            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');

            User::create([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),
            ]);

            return redirect('added')->with('username',"$username");
            //addedのsessionに$usernameの値を送る
        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}
