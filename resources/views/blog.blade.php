@extends('layouts.frontend')
@section('content')
@if($posts)

<?php $counter=1; ?>
	 @foreach($posts as $post)

<div class="row" id='blog-wrapper'>
		<img src="{{ $post['picture'] }}" width='100%' height='500'>
		<br><hr>
		<a href="{{route('single.post',$post['id'])}}"><h3>{{ $post['title'] }}</h3></a>
		<span><small>Author : </small> {{ $post->User->name }}</span>   |   
		<span><small>Categories : </small> {{ $post->Category->category }}</span>  |
		<span><small>Published : </small> {{ $post['created_at'] }}</span>
		<p><?php echo strip_tags($post['content']); ?></p>
		<br>
</div>
	 @endforeach
@endif
{{ $posts->links() }}

@endsection
