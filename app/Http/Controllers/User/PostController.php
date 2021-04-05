<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user\post;
use App\Models\user\comment;


class PostController extends Controller
{

    public function index(){

        return view('user.post');
    
    }


    public function show($id){
      
        $posts = post::where('id', $id) -> first();
        $comments = comment::orderBy('id', 'DESC')-> get();
        return view('user.post', compact('posts', 'comments'));
    
    }


    public function create(){
        return view('user.create_blog');
    }


    public function store(Request $request, $author_name){
        
        $this->validate($request, [

            'title' => 'required|unique:posts,title',
            'sub_title' => 'required',
            'slug' => 'required',
            'body' => 'required',

        ]);

        $post = new post;
        $post -> title = $request -> title;
        $post -> sub_title = $request -> sub_title;
        $post -> slug = $request -> slug;
        $post -> author_name = $author_name;
        $post -> body = $request -> body;
        $post -> status = $request -> status;


        if($post -> status == 'on'){
            $post -> status = true;
        } else {
            $post -> status = false;
        }

        if($request -> has('image')){

            $post -> image = $request -> file('image');
            $rename_img = time().'.'.$post -> image -> getClientOriginalExtension();
            $dest = public_path('/img');
            $post -> image -> move($dest, $rename_img);
            $post -> image = $rename_img;
            $post -> save();

            return redirect(route('create_blog')) -> with('success', "Post Created Successfully!");

        } else {

            return redirect(route('create_blog')) -> with('message', "Input Image file");

        }
    }

    public function store_comments(Request $request, $id){

        $this->validate($request, [
            'comment' => 'required',
        ]);

        $comment = new comment;
        $comment -> post_id = $id;
        $comment -> user_name = session() -> get('author_name');
        $comment -> comments = $request -> comment;

        $comment -> save();
        return redirect() -> back();

    }
}
