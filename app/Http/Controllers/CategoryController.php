<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

use Session;
use App\Post;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.addcategory');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::user()->id;
        //$post = DB::table('posts')->where('author', $user_id)->get();
        $allcategories = Category::where('author', $user_id)->get();

       
        return view('admin.category.updatecategory')->with('categories',$allcategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if((Category::where(['category' => $request->category,'author'=>$request->author]))->count()>0){
              echo "<span class='alert alert-danger'>Category Already Exists</span>";
         }else{
               $categoryHandler = new Category;
               $categoryHandler->category = $request->category;
               $categoryHandler->token = $request->_token;
               $categoryHandler->author = $request->author; 
               $categoryHandler->save();

               if($categoryHandler->save()){
                 echo "<span class='alert alert-success'>Category Has Been Added Successfully</span>";
               }else{
                 echo "<span class='alert alert-danger'>Failed ,Contact Admin</span>";
               }
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $categories = Category::where('category', $id)->get();
        //$id here is the category name
        //$posts = Post::where('category', $id)->get();
        for ($i=0; $i < count($categories); $i++) { 
            $posts[] = Post::where('category', $categories[$i]['id'])->get();
        }

        return view('category')->with('posts',$posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          return view('admin.category.editcategory')->with('name',$id);
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
        //return view('admin.category.test');
      $categoryNew = $request->input('category');
      DB::table('categories')
          ->where('category', $id)
          ->update(['category' => $categoryNew]);

      echo "Data Updated Successfully";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          DB::table('categories')
              ->where('category', $id)->delete();
          echo "Data Deleted Successfully";


    }
}
