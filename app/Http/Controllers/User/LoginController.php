<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user\User;
use Exception;

class LoginController extends Controller
{
    public function index()
    {

        return view('user.login');

    }

    

    public function checklogin(Request $request){

        $this->validate($request, [

            'email' => 'required',
            'password' => 'required|min:6',

        ]);

        $login = new User;

        $login -> email = $request -> email;
        $login -> password = $request -> password;
        
        try{

            $data = User::where('email', $login -> email) -> firstOrFail();

            if($data -> password != $login -> password){
    
                return redirect( route('user_login')) -> with("message","Invalid Password");
                 
            } else {
    
                $request -> session() -> put('author_name', $data -> name);
                return redirect('/');
            }
        } catch(\Exception $ex){
            return redirect( route('user_login')) -> with("message","Invalid Email");
        }
        
        
    }
}
