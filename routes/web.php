<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
      Auth::routes();

      Route::get('/home', 'HomeController@index')->name('home');
      
      


      // route for search 
      Route::post('/search/{id}',[
        'uses'=>'SearchController@show',
        'as'=>'search'
      ]);
      // Route::get('/', function () {
      //     return view('index');
      // });

      //Displaying posts to front end  'as'=>'home'
      Route::get("/",['uses'=>'FrontpageController@index'])->name('home');

      Route::get("/test",[
        'uses'=>'Auth\LoginController@handleProviderCallback',
        'as'=>'test'
      ]);

      Route::get('/blog',[
        'uses'=>'BlogController@index',
        'as'=>'blog'
      ]);
      //displaying all author posts frontend
      Route::get('/author/posts/{id}',[
        'uses'=>'UserController@show',
        'as'=>'author.posts'
      ]);

      //display all posts by category frontend
      Route::get('/category/posts/{id}',[
          'uses'=>'CategoryController@show',
          'as'=>'category.posts'
        ]);

      //display single post frontend

      Route::get('/single/post/{id}',[
        'uses'=>'PostController@show',
        'as'=>'single.post'
      ]);
      



      Route::get('login/github', 'Auth\LoginController@redirectToProvider');
      Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');


Route::group(['middleware' => 'auth'], function(){
      
      //delete comment admin 
      Route::post('/delete/{id}',[
        'uses'=>'CommentController@destroy',
        'as'=>'comment.delete'
      ]);


      //approve a comment from admin
      Route::post('/approve/{id}',[
        'uses'=>'CommentController@update',
        'as'=>'comment.ckeck'
      ]);
  
  
      //adding reply to database
      Route::post('/reply',[
        'uses'=>'ReplyController@store',
        'as'=>'reply'
      ]);
  
  
      //adding comments to database
      Route::post('/comment',[
        'uses'=>'CommentController@store',
        'as'=>'comment'
      ]);
  
      //route for adding form for new post
      Route::get('/post/addpost',[
          'uses'=>'PostController@index',
          'as'=>'admin.addpost'
      ]);

      //Adding posts using ajaxupload
      Route::post("/post/store",[
        'uses'=>'PostController@store',
        'as'=>'post.store'
      ]);

      //Adding posts using ajaxupload
      Route::get("/post/create",[
        'uses'=>'PostController@create',
        'as'=>'post.create'
      ]);

      
      //route for adding form for new category
      Route::get('/post/addcategory',[
          'uses'=>'CategoryController@index',
          'as'=>'admin.addcategory'
      ]);

      //storing categories to database
      Route::post('/post/addcategory',[
        'uses'=>'CategoryController@store',
        'as'=>'admin.addcat'
      ]);


      //getting all categories and displaying them
      Route::get('/post/showcategory',[
        'uses'=>'CategoryController@create',
        'as'=>'admin.showcategory'
      ]);

      //getting single category
      Route::get('/post/editcategory/{name}',[
        'uses'=>'CategoryController@edit',
        'as'=>'admin.editcategory'
      ]);

      //updating single category
      Route::put('/upcategory/{name}',[
        'uses'=>'CategoryController@update',
        'as'=>'admin.upcat'
      ]);

      //delete category
      Route::get("/deletecategory/{id}",[
        'uses'=>'CategoryController@destroy',
        'as'=>'admin.deletecategory'
      ]);



      //adding tags
      Route::get("/post/addtags",[
        'uses'=>'TagController@index',
        'as'=>'admin.addtags'
      ]);


      //processing tags form
      Route::post('/tag/store',[
        'uses'=>'TagController@store',
        'as'=>'admin.datatag'
      ]);

      //displaying tags in edit page
      Route::get("tag/create",[
        'uses'=>'TagController@create',
        'as'=>'admin.showtags'
      ]);

      //displaying all comments for single user in edit-delete tab backend
      Route::get('/comments/{id}',[
        'uses'=>'CommentController@show',
        'as'=>'comments.show'
      ]);


 });
