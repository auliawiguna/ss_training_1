<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller{

    public function __construct(\App\User $user)
    {
        $this->user = $user;
    }

    public function registerForm()
    {
        return view('register/index');
    }    

    public function registerSave(Request $request)
    {
        $data = $request->input();
        if ($data['password'] != $data['password2']) {
            die('Password Did Not Match');            
        } else {
            $validation =  \Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6'],
            ]);            

            if (!$validation->fails()) {
                $data['password'] = \Hash::make($data['password']);
                $create = $this->user->create($data);
                if ($create) {
                    return view('register/success');
                } else {
                    return 'Registration Failed';                    
                }
            } else {
                return 'Invalid Validation';
            }
        }
    }    
    
}
