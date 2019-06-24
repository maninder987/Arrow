<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comments;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comments = new Comments;
        $comments->message = $request->message;
        $comments->post_id = $request->post_id;
        $comments->user_id = $request->user_id;
        $comments->author = $request->author;        
        $comments->token = $request->_token;  
        $comments->save();  
        
        //return $request->message;
        echo "<p>Your Comment Has Been Added </p><br><div class='media-body alert alert-success'>
                    <p>$request->message</p>
                    <blockquote>Your Comment Will Be Available To Everyone Once Approved</blockquote>
                    </span>
                </div><br><hr>";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comments = Comments::where("user_id","=",$id) ->orderBy('id', 'Desc')->get();
        
        return view('admin.comments.display')->with('comments',$comments);

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

        $comment = Comments::where('id', '=', $id)->first();
        if($comment['approve']=='false'){
            $updated =  Comments::where("id","=",$id)->update(['approve' => "true"]);
            if($updated){
                return "Comment Successfully Approved";
            }else{
                return "Cannot Approve Comment At This Time";
            }
        }else{
            $updated =  Comments::where("id","=",$id)->update(['approve' => "false"]);
            if($updated){
                return "Comment Successfully Disapproved";
            }else{
                return "Cannot Disapprove Comment At This Time";
            }
        }
    
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteComment = Comments::find($id);
        $deleteComment->delete();
        return "Comment Deleted Successfully";
    }
}
