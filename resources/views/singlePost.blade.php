@extends('layouts.frontend')
@section('content')
@if($post)

<div class="row" id='single-wrapper'>
		<img src="/{{ $post['picture'] }}" width='100%' height='500'>
		<br><hr>
		<h3>{{ $post['title'] }}</h3>
        <span><small>Author:</small> <a href="{{ route('author.posts',$post['author'])}}">{{ ucfirst($post->User->name) }}</a></span>   |   
													<span><small>Categories:</small> <a href="{{ route('category.posts',strtolower($post->Category->category))}}">{{ ucfirst($post->Category->category) }}</a></span>
													|
		<span><small>Published : </small> {{ $post['created_at'] }}</span> | <span>Comments : <?php echo count($comments); ?> </span><p><?php echo strip_tags($post['content']); ?></p>
		<br>
		<hr>
			<h3>Leave A Comment <?php if(Auth::user()){ echo ucfirst(Auth::user()->name); } ?></h3>
		<hr>
		@if(Auth::check()) 
		<form class='commentForm'>
			<div class="form-group">
				<textarea name="comment" id="editor" cols="100" rows="20" class='commentContent'></textarea>
			</div>
			<input type="hidden" class='commentData' post-id="{{ $post['id'] }}" comment-sender='{{Auth::user()->id}}' data='{{ csrf_token() }}' author="{{$post->User->name}}">
			<div class="form-group">
				<input type="submit" class='btn btn-primary'> 
			</div>	
		</form>
		<!-- <span class='alertAfterComment alert alert-success' align='left'></span> -->
		<span class='alertAfterCommentError alert alert-danger' align='left'></span>
		@else
		<div class="card">
			<div class="card-body">
			<a href="{{ url('/login') }}" >You Need To Login To Leave A Comment</a>
			</div>
		</div>
			
		@endif

</div>

@endif

@if($comments)

		<hr>
			<h3>Recent Comment </h3>
		<hr>
		<div class="thumbnail">
		<div class="commentOutput">
		<h5 class='alertAfterReply alert alert-success' align='left'></h5>
		<h5 class='alertAfterReplyError alert alert-danger' align='left'></h5>
		<?php $counter = 0;  ?>
			@foreach($comments as $comment)
			@if($comment['approve']=='true')
			<div class="media">
				<div class="media-left media-middle">
					<a href="#">
				
						<!-- <img class="media-object" src="..." alt="..."> -->
					</a>
				</div>
				<div class="media-body">
							
							<p>{{ucfirst(strip_tags($comment['message']))}}</p>
							<img src="{{$comment->user->githubAvatar}}" alt="$comment['message']" width='100' height='100' class="userImage">
							By : 	<span class="media-heading"> {{$comment->user->name}} |   When : {{$comment['created_at']}} </span>
							<p>
								<a class='makeReply'>
									Reply
								</a>
									 |  
						@if($reply)
										<a class='showReplies'>
										<?php
										$counter=0;
												for ($i=0; $i <count($reply) ; $i++){ 
														if($comment['id']==$reply[$i]['under_comment']){
															$counter=$counter+1;  
														}
												};
												echo "Total Replies :".$counter;
										?>
									</a>
						@endif
							</p>
							<div class="replyInput">
								<div class="card card-body">
								@if(Auth::check()) 
									<form>
										<div class="form-group">
											<input type="text" comment-id="{{$comment['id']}}" post-id="{{ $post['id'] }}" reply-sender='{{Auth::user()->id}}' class='form-control replyInputField' data='{{ csrf_token() }}' placeholder="Add Reply Here">
										</div>
										<div class="form-group">
											<input type="submit" value="Send" class='btn btn-primary replyButton'>
											<h5 class='replyAlert alert alert-danger'></h5>
										</div>
										
									</form>
								@else
								<div class="card">
									<div class="card-body">
									<a href="{{ url('/login') }}" >You Need To Login To Leave A Comment</a>
									</div>
								</div>
								@endif
								</div>
							</div>
							
							<hr>
							<div class="replyBoxWrapper">
																		<!-- reply output -->
																@if($reply)
																<div class="replyOutputBox">	
																		<?php
																					for ($i=0; $i <count($reply) ; $i++) { 
																						?>
																								@if($comment['id']==$reply[$i]['under_comment'])
																									<div class="card">
																											<div class="card-body">
																												<p class='eachReply'>{{strip_tags(ucfirst($reply[$i]['reply']))}}</p>
																												<small>By : {{$reply[$i]['replied_by']}}  | When :  {{$reply[$i]['created_at']}}</small>
																											</div>
																									</div>		
																									<br>
																									@endif
																					<?php
																					}
																		?>
															
																</div>							
															@endif
							</div>

							<hr>
				</div>
			</div>


			@else													
			<?php	if($comment->User->name ==  Auth::user()->name ){  ?>
				 
					<?php  if($counter==0){  ?>
					<h4 class='alert alert-info'>Comment Is Pending For Admin Approval</h4>
					<br>
					<hr>
					<?php }else{
						echo " ";
					}
					$counter=$counter+1; 
			}
				?>																		
			@endif
			@endforeach
				
		
		   
		</div>
		</div>

@endif
<br>
<h2 align='center'> Related Latest Posts</h2>
<hr><br>
<section id="demos">
      <div class="row">
			
        <div class="large-12 columns">
          <div class="owl-carousel owl-theme">
		  <?php

			for ($i=0; $i < count($category); $i++) { 
				?>
				<div class="item">
				<a href="{{route('single.post',$category[$i]['id'])}}"><img src="/{{$category[$i]['picture']}}" alt="{{$category[$i]['title']}}" class='img-responsive'></a>
					<div class="card">
						<div class="card-body">
							<p>{{$category[$i]['title']}}</p>
						</div>
					</div>
				</div>
				
				<?php
			}
		  ?>
          </div>
     
         
        </div>
      </div>
    </section>

@endsection
