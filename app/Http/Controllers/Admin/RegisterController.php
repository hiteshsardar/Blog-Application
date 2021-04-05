<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\admin;


class RegisterController extends Controller
{
    public function index()
    {

        return view('admin.register');

    }


    public function admin_register(Request $request){

        $this->validate($request, [

            'name' => 'required',
            'email' => 'required|unique:admins,email',
            'password' => 'required|min:6',
            'cpassword' => 'required|min:6',

        ]);

        $register = new admin;

        $register -> name = $request -> name;
        $register -> email = $request -> email;
        $register -> password = $request -> password;

        if($register -> password != $request -> cpassword){
            return redirect( route('admin.register')) -> with("message","Password are not matching");
        } else {

            $register -> save();
            return redirect(route('admin_login'));

        }

    }
}
