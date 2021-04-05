<?php

use Illuminate\Support\Facades\Route;


// User Controller
Route::group(['namespace' => 'User'], function () {


    // Home
    Route::get('/','HomeController@index'  )-> name('blog');



    // Post View
    Route::get('post', 'PostController@index') -> name('post');
    Route::get('show/{id}', 'PostController@show') -> name('show');



    // Store Comments
    Route::Post('comment/{id}', 'PostController@store_comments') -> middleware('user_auth') -> name('user_comment');



    // Blog Creation Form
    Route::get('user/blog','PostController@create') -> middleware('user_auth') -> name('create_blog');
    // Blog Creation
    Route::post('user/blog/create/{author_name}','PostController@store') -> name('blog_store');



    // User Registration View
    Route::get('user-register', 'RegisterController@index') -> middleware('user_auth') -> name('register');
    // User Registration
    Route::post('user-register', 'RegisterController@user_register') -> name('user_register');


    // User Login
    Route::post('/checklogin','LoginController@checklogin');

    // User Login View 
    Route::get('/user_login', function(){

        if(session() -> has('author_name')){

            return redirect('user/blog');

        }

        return view('user.login');

    }) -> middleware('user_auth') -> name('user_login');
        


    // User Logout
    Route::get('/user_logout', function(){

        if(session() -> has('author_name')){
            session() -> pull('author_name');
        } 

        return redirect('/');

    });

});





// Admin Controller
Route::group(['namespace' => 'Admin'], function(){


    Route::get('admin/home', 'HomeController@home') -> middleware('admin_auth') -> name('admin.home');


    // Post Route
    Route::resource('admin/user','UserController') -> middleware('admin_auth');

    // Post Route
    Route::resource('admin/post','PostController') -> middleware('admin_auth');

    // Tag Route
    Route::resource('admin/tag','TagController') -> middleware('admin_auth');

    // Category Route
    Route::resource('admin/category','CategoryController') -> middleware('admin_auth');

    // List Search
    Route::get('/search','PostController@search');

    // Check Image
    Route::get('check_img', 'PostController@check_image') -> name('check_img');

    // Admin Registration View
    Route::get('admin-register', 'RegisterController@index') -> middleware('admin_auth') -> name('admin.register');

    // Admin Registration
    Route::post('admin-register', 'RegisterController@admin_register') -> name('admin.admin_register');

    // Admin login
    Route::post('admin-check', 'LoginController@checklogin') -> name('admin.checklogin');

    // User list View
    Route::get('/user_list', 'UserController@show');

    // Assending list
    Route::any('admin_assen','PostController@index') -> name('assending_order');
    Route::get('admin_descn','PostController@decending') -> name('descending_order');

     // Admin Login View
    Route::get('/admin_login', function(){

        if(session() -> has('admin_name')){
            return redirect('admin/home');
        }

        return view('admin.login');

    }) -> middleware('admin_auth') -> name('admin_login');

        
    // Admin Logout
    Route::get('/admin_logout', function(){

        if(session() -> has('admin_name')){
            session() -> pull('admin_name');
        } 

        return redirect('/');

    });

});




