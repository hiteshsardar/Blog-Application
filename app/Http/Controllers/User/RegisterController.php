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

    public function upload(Request $request){

        if($request -> ajax()){
            $image_data = $request -> image;
            $image_array_1 = explode(";", $image_data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);

            $image_name = time().'.png';
            $upload_path = public_path('user_img/'.$image_name);
            file_put_contents($upload_path, $data);

            return response() -> json(['path' => $image_name]);
        }
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
        $register -> image = $request -> user_img;
        
        if($register -> password != $request -> cpassword){
            return redirect( route('user_register')) -> with("message","Password are not matching");
        } else {

            $register -> save();
            return redirect(route('user_login'));

        }
    }
}
