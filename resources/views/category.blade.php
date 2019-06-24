@extends('layouts.frontend')
@section('content')


@if($posts)
<?php
  for($i=0; $i<count($posts); $i++){
	?>
			 @foreach($posts[$i] as $post)
		<div class="row" id='blog-wrapper'>
			<?php if($i==0){ ?>
				<hr>
				<br><br>
				<h1 align='center'>Posts Of Category : {{ $post->Category->category }}</h1>
				<br>
				<hr>
				<br>
			<?php  } ?>	
				<img src="/{{ $post['picture'] }}" width='100%' height='500'>
				<br><hr>
				<a href="#"><h3>{{ $post['title'] }}</h3></a>
				<span><small>Author:</small> <a href="{{ route('author.posts',$post['author'])}}">{{ $post->User->name }}</a></span>   |   
				<span><small>Categories:</small> {{ $post->Category->category }}</span>
				<p><?php echo strip_tags($post['content']); ?></p>
				<br>
		</div>
			@endforeach
	<?php
  }

  ?>
@endif


@endsection
