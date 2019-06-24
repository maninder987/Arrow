@extends('layouts.admin')

@section('content')
<div class="container">
<br><br>
        <div class="row">
                <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    <h3 class="box-title">Comments List</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                        </div>
                    </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Comment ID</th>
                            <th>Post Author</th>
                            <th>Message From</th>
                            <th>Post Comment From</th>
                            <th>Comments</th>
                            <th>Reply</th>
                            <th>Approve</th>
                            <th>Delete</th>
                            <th>Time</th>
                        </tr>
                @if($comments)
                    @foreach($comments as $comment)
                        <tr class='eachCommentAdmin'>
                            <td> {{$comment['id']}}</td>
                            <td>{{$comment['author']}}</td>
                            <td> {{$comment['user_id']}}</td>
                            <td>{{$comment['post_id']}}</td>
                            <td>{{strip_tags($comment['message'])}}</td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#modal-info">
                                    <span under_comment="{{$comment['id']}}" post_id="{{$comment['post_id']}}" replied_by="{{ Auth::user()->id }}"  token='{{csrf_token()}}'  class="label label-info replyAdmin">Reply</span>
                                </a>
                            </td>
                            <td>
                                @if($comment['approve']=='true')
                                        <a href="#"  data-toggle="modal" >
                                            <span class="label label-success approveComment" under_comment="{{$comment['id']}}" token='{{csrf_token()}}'>
                                                Approved
                                            </span>
                                        </a>
                                @else
                                        <a href="#"  data-toggle="modal" >
                                            <span class="label label-primary approveComment" under_comment="{{$comment['id']}}" token='{{csrf_token()}}'>
                                                Approve 
                                            </span>
                                        </a>  
                                        <span class='newComment'>
                                        | New Comment  <i class="fa fa-star" aria-hidden="true"></i> 
                                        </span> 
                                        
                                @endif
                            
                            </td>
                            <td><a href="#"><span token='{{csrf_token()}}' under_comment="{{$comment['id']}}" class="label label-danger deleteCommentAdmin">Delete</span></a></td>
                            <td>{{$comment['created_at']}}</td>
                        </tr>
                    @endforeach
                @endif  
                    </tbody>
                </table>
               
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            
                <span class="alert alert-success successDeleteComment" ></span>
                <span class="alert alert-danger errorDeleteComment" ></span>
            </div>
            </div>

           


                
        <div class="modal modal-info fade" id="modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Info Modal</h4>
              </div>
              <div class="modal-body">
               <div class="boxWrapperReply">
                        <form class='reply_message_admin'>
                            <div class="form-group">
                                    <textarea class="form-control replyAuthorAdmin"  id="editor" name="summary-ckeditor"></textarea>
                            </div>
                        </form>
               </div>
               <div class="boxWrapperEdit">
                   <form>
                       <div class="form-group">
                           <input type="text" class="form-control">
                       </div>
                   </form>
               </div>
            </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-outline pull-left closeReplyModelAdmin" data-dismiss="modal" onclick="this.form.reset();">Close</button>
                <button type="button"  class="sendReplyAdmin btn btn-outline">Send</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
            
                
            


        </div>

@endsection
