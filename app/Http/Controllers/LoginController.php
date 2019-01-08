<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller{

    public function __construct(\App\User $user)
    {
        $this->user = $user;
    }

    public function loginForm()
    {
        return view('welcome');
    }

    public function loginAuth(Request $request)
    {
        $rules = array(
            'email'    => 'required|email', 
            'password' => 'required|min:6'
        );
        $validator = validator($request->input(), $rules);

        if ($validator->fails()) {
            return \Redirect::to('')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput($request->except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {
            $userdata = array(
                'email'     => $request->input('email'),
                'password'  => $request->input('password')
            );

            if (\Auth::attempt($userdata)) {
                \Session::put('id', \Auth::id());
                \Session::put('email', $request->input('email'));
                return redirect('/dashboard');
            } else {
                return redirect('/');
            }
        }
    }

    public function logOut()
    {
        \Auth::logout();
        \Session::flush();
        return redirect('/');
    }
}
