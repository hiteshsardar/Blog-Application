<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user\post;
use App\Models\user\comment;
use App\Models\user\post_image;


class PostController extends Controller
{

    public function index(){

        return view('user.post');
    
    }


    public function show($post_id){
      
        $posts = post::where('post_id', $post_id) -> first();
        $comments = comment::orderBy('id', 'DESC') -> where('post_id', $post_id) -> get();
        $post_image = post_image::where('post_id', $post_id) -> get();
        return view('user.post', compact('posts', 'post_image', 'comments'));
    
    }


    public function create(){
        return view('user.create_blog');
    }


    public function store(Request $request, $author_name){

        $refrence_id = 0;

        do {

            $refrence_id = mt_rand( 1000000000, 9999999999 );
            
        } while ( post::where( 'post_id', $refrence_id )->exists() );
        
        $this->validate($request, [

            'title' => 'required|unique:posts,title',
            'sub_title' => 'required',
            'slug' => 'required',
            'body' => 'required',

        ]);

        $post = new post;
        $post -> post_id = $refrence_id;
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

        if($request -> hasFile('image')){

            foreach($request -> image as $file){

                $post_img = new post_image;
                // $this->validate($request, [
                //     'img_title' => 'required',
                // ]);
                
                print_r($request -> img_title);
                $post_img -> post_id = $refrence_id;

                $post_img -> image = $file;
                
                $rename_img = time().'.'.$post_img -> image -> getClientOriginalName();
                $dest = public_path('/img');
                $post_img -> image -> move($dest, $rename_img);
                $post_img -> image = $rename_img;
                $post_img -> save();
              
            }
            
            $post -> save();
            return redirect(route('create_blog')) -> with('success', "Post Created Successfully!");

        } else {

            return redirect(route('create_blog')) -> with('message', "Input Image file");

        }

    }

    public function store_comments(Request $request, $post_id){

        $this->validate($request, [
            'comment' => 'required',
        ]);

        $comment = new comment;
        $comment -> post_id = $post_id;
        $comment -> user_name = session() -> get('author_name');
        $comment -> comments = $request -> comment;

        $comment -> save();
        return redirect() -> back();

    }

    public function Post_Likes(Request $request, $post_id){

        if($request -> ajax()){

            $post = post::select('id', 'like') -> where('post_id', $post_id) -> first();
            
            $post -> like = $post -> like + 1;
            $post -> save();

            return response() -> json(['like' => $post -> like]);
        }
    }

    public function Post_Dislikes(Request $request, $post_id){

        if($request -> ajax()){

            $post = post::select('id', 'dislike') -> where('post_id', $post_id) -> first();
            
            $post -> dislike = $post -> dislike + 1;
            $post -> save();

            return response() -> json(['like' => $post -> dislike]);
        }
    }

    public function Comment_Likes(Request $request, $post_id){

        if($request -> ajax()){

            $comment = comment::select('id', 'like') -> where('post_id', $post_id) -> first();
            
            $comment -> like = $comment -> like + 1;
            $comment -> save();

            return response() -> json(['like' => $comment -> like]);
        }
    }

    public function Comment_Dislikes(Request $request, $post_id){

        if($request -> ajax()){

            $comment = comment::select('id', 'dislike') -> where('post_id', $post_id) -> first();
            
            $comment -> dislike = $comment -> dislike + 1;
            $comment -> save();

            return response() -> json(['like' => $comment -> dislike]);
        }
    }
}
