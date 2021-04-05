<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user\User;


class RegisterController extends Controller
{
    public function index()
    {

        return view('user.register');

    }


    public function user_register(Request $request){

        $this->validate($request, [

            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'cpassword' => 'required|min:6',

        ]);

        $register = new User;

        $register -> name = $request -> name;
        $register -> email = $request -> email;
        $register -> password = $request -> password;

        if($register -> password != $request -> cpassword){
            return redirect( route('user_register')) -> with("message","Password are not matching");
        } else {

            $register -> save();
            return redirect(route('user_login'));

        }
    }
}
