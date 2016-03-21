<?php

namespace Gecx\Http\Controllers\Auth;

use Gecx\User;
use Validator;
use Gecx\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;

class AuthController extends Controller{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    protected $redirectTo = '/';

    public function __construct(){
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function postLogin(Request $request){
        if (Auth::attempt(
            [
                'email' => $request->email,
                'password' => $request->password,
                'active' => 1
            ]
            , $request->has('remember')
            )){
        return redirect()->intended($this->redirectPath());
        }
        else{
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $messages = [
            'email.required' => 'El campo email es requerido',
            'email.email' => 'El formato de email es incorrecto',
            'password.required' => 'El campo password es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        return redirect('auth/login')
        ->withErrors($validator)
        ->withInput()
        ->with('message', 'Error al iniciar sesión');
        }
    }

}
