<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

use App\Post;

use App\User;

use App\Comments;

use DB;

use App\Replies;

use Illuminate\Support\Facades\Auth;

use Validator;

use Session;

use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\File;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $category = Category::where('author', $user_id)->get();
        return view('admin.post.addpost')->with('categories',$category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $user_id = Auth::user()->id;
        //$post = DB::table('posts')->where('author', $user_id)->get();
        $post = Post::with('category')->where('author', $user_id)->paginate(5);
        //$post = Post::all();
        $user = $post;
        $category = Category::all();
        return view('admin.post.display')->with('posts',$post)
                                         ->with('categories',$category)
                                         ->with('user',$user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->hasFile('pimage')) {
             $post = new Post;
             $post->title = $request->Input('title');
             $post->content = $request->Input("content");
             $post->category =   $request->Input('category');
             $image = $request->file('pimage');
             $post->tabs = $request->tags;
             $post->author = $request->Input('authorid');



             $image_name = time().'.'.$image->getClientOriginalExtension();
             $destinationPath = public_path('/images');
             $image->move($destinationPath, $image_name);
             $post->picture='images/'.$image_name;
             $post->save();

             echo"<span class='alert alert-success'>Post Published Successfully</span>";
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
        //$post = Post::find($id);
        $reply = Replies::where("post_id","=",$id) ->orderBy('id', 'Desc')->get();
        $comments = Comments::where("post_id","=",$id) ->orderBy('id', 'Desc')->get();
        $post = Post::where("id", "=", $id)->first();
        $postsSameCategory = Post::where("category", "=", $post['category'])->get();
        $result = $postsSameCategory->toArray();
        return view('singlePost')->with('post',$post)
                                 ->with('category',$result)
                                 ->with('comments',$comments)
                                 ->with('reply',$reply);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
