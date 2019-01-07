<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class RegistrationController extends Controller{
    //
    public function registerform(){
        return view('register/index');
    }    

    public function registersave(){
        $data = \Request::all();
        if($data['password'] != $data['password2']){
            die('Password Did Not Match');            
        }else{

            $validation =  \Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6'],
            ]);            

            if (!$validation->fails()) {
                $data['password'] = \Hash::make($data['password']);
                $create = \App\User::create($data);
                if($create){
                    return view('register/success');
                }else{
                    echo 'Registration Failed';                    
                }
            }else{
                echo 'Invalid Validation';
            }            
        }

    }    

}
