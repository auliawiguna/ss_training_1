<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller{
    public function loginform(){
        return view('welcome');
    }    

    public function loginauth(){
        $rules = array(
            'email'    => 'required|email', 
            'password' => 'required|min:6'
        );
        $validator = \Validator::make(\Request::all(), $rules);

        if ($validator->fails()) {
            return \Redirect::to('')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(\Request::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {
            $userdata = array(
                'email'     => \Request::get('email'),
                'password'  => \Request::get('password')
            );

            if (\Auth::attempt($userdata)) {
                // \Session::put('name', \Auth::user());
                \Session::put('id', \Auth::id());
                \Session::put('email', \Request::get('email'));
                return \Redirect::to('/dashboard');
            } else {        
                return \Redirect::to('/');
            }
        }        
    }

    public function logout(){
        \Auth::logout();
        \Session::flush();
        return \Redirect::to('/');
    }

}
