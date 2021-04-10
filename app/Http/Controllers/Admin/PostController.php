<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\user\post;
use Illuminate\Http\Request;
use App\Models\user\User;
use App\Models\user\post_image;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = post::simplePaginate(5);
        return view('admin.post.show', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $author_list = User::select('name') -> get();
        return view('admin.post.post', compact('author_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        $post -> status = $request -> status;
        $post -> author_name = $request -> author_name;
        $post -> body = $request -> body;
        
        if($post -> status == 'on'){
            $post -> status = true;
        } else {
            $post -> status = false;
        }

        if($post -> author_name == 'Select'){
            return redirect(route('post.create')) -> with('message', "Select Author");
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
            return redirect(route('post.create')) -> with('success', "Post Created Successfully!");

        } else {

            return redirect(route('post.create')) -> with('message', "Input Image file");
    
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request -> search;
        $posts = post::where('title', 'like', '%'.$search.'%') -> simplePaginate(5);
        return view('admin.post.show', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = post::where('id', $id) -> first();
        return view('admin.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [

            'title' => 'required',
            'sub_title' => 'required',
            'slug' => 'required',
            'body' => 'required',

        ]);

        $post = post::find($id);
        $post -> title = $request -> title;
        $post -> sub_title = $request -> sub_title;
        $post -> slug = $request -> slug;
        $post -> body = $request -> body;
        $post -> status = $request -> status;

        if($post -> status == 'on'){
            $post -> status = true;
        } else {
            $post -> status = false;
        }
        $post -> save();

        return redirect(route('post.index'))  -> with('success', "Post Updated Successfully!");    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id)
    {
        post::where('post_id', $post_id) -> delete();
        post_image::where('post_id', $post_id) -> delete();
        return redirect() -> back();
    }

    public function decending()
    {
        $posts = post::orderBy('id', 'DESC') -> simplePaginate(5);
        return view('admin.post.show', compact('posts'));
    }

}
