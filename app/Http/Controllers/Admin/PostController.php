<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\user\post;
use Illuminate\Http\Request;
use App\Models\user\User;



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

        if($request -> has('image')){

            $post -> image = $request -> file('image');
            $rename_img = time().'.'.$post -> image -> getClientOriginalExtension();
            $dest = public_path('/img');
            $post -> image -> move($dest, $rename_img);
            $post -> image = $rename_img;
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
    public function destroy($id)
    {
        post::where('id', $id) -> delete();
        return redirect() -> back();
    }

    public function decending()
    {
        $posts = post::orderBy('id', 'DESC') -> simplePaginate(5);
        return view('admin.post.show', compact('posts'));
    }

    public function check_image(Request $request){

        print_r("Hitesh");

        // $this->validate($request, [

        //     'image' => 'required|image|mimes:png,jpg,jpeg,gif|max:3072'

        // ]);

        // $image = $request -> file('image');
        // $new_name = rand().'.'.$image -> getClientOriginalExtension();
        // $image -> move(public_path('images'), $new_name);

        // return response() -> json([
        //     'message' => 'Image Uploaded Successfully',
        //     'uploaded_image' => '<img src="/images/'.$new_name.'" class="img-thumbnail" width="300"/>',
        //     'class_name' => 'alert-success'
        // ]);
    }
}
