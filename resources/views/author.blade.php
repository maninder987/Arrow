@extends('layouts.frontend')
@section('content')


@if($posts)
<br>
<hr>
<br>
<h1 align='center'>Posts By Author : {{strtoupper($user['name'])}}</h1>
     @foreach($posts as $post)
<br>
<hr>
<div class="row">
		<img src="/{{ $post['picture'] }}" width='100%' height='500'>
		<br><br>
		<h3>{{ $post['title'] }}</h3>
		<span><small>Author:</small>{{strtoupper($user['name'])}}</span>   |   
		<span><small>Categories:</small><a href="{{ route('category.posts',strtolower($post->Category->category))}}">{{$post->Category->category}}</a></span>
        <p><?php echo substr(strip_tags($post['content']),0,250); ?></p>
        <p><a href="#" class="btn btn-primary">Read More <?php if(Auth::user()){ echo ucfirst(Auth::user()->name); } ?></a></p>
		<br>
</div>

	 @endforeach
@endif


@endsection
