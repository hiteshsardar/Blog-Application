<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\admin;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    
    public function index()
    {

        return view('admin.login');

    }

    

    public function checklogin(Request $request){

        $this->validate($request, [

            'email' => 'required',
            'password' => 'required|min:6',

        ]);

        $login = new admin;

        $login -> email = $request -> email;
        $login -> password = $request -> password;

        $data = admin::where('email', $login -> email) -> first();
        
        try{

            if($data -> password != $login -> password){

                return redirect( route('admin_login')) -> with("message","Invalid Password");
                 
            } else {
    
                $request -> session() -> put('admin_name', $data -> name);
                return redirect( route('admin.home'));
            }

        } catch(\Exception $ex){

            return redirect( route('admin_login')) -> with("message","Invalid Email");

        }
                
    }

}
