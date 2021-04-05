<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user\post;


class HomeController extends Controller
{

    public function index(){

        $posts = post::orderBy('id', 'DESC') -> where('status',1) -> simplePaginate(4);
        return view('user.blog', compact('posts'));
    }

    public function check($id){
        $id;
    }
}
