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


    public function upload(Request $request){

        if($request -> ajax()){
            $image_data = $request -> image;
            $image_array_1 = explode(";", $image_data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);

            $image_name = time().'.png';
            $upload_path = public_path('admin_img/'.$image_name);
            file_put_contents($upload_path, $data);

            return response() -> json(['path' => $image_name]);
        }
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
        $register -> image = $request -> admin_img;

        if($register -> password != $request -> cpassword){
            return redirect( route('admin.register')) -> with("message","Password are not matching");
        } else {

            $register -> save();
            return redirect(route('admin_login'));

        }

    }

}
