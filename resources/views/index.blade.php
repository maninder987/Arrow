@extends('layouts.frontend')




@section('content')
							<video id="bgvid" playsinline autoplay muted loop>
								<!-- poster="https://s3-us-west-2.amazonaws.com/s.cdpn.io/4273/polina.jpg" 
							- Video needs to be muted, since Chrome 66+ will not autoplay video with sound.
							WCAG general accessibility recommendation is that media such as background video play through only once. Loop turned on for the purposes of illustration; if removed, the end of the video will fade in the same way created by pressing the "Pause" button  -->
							<source src="/videos/arrowempire.com.webm" type="video/webm">
							<source src="video/arrowempire.com.mp4" type="video/mp4">

							</video>
@if($latestPost)
							<div id="polina">
							<h4>Most Latest Post</h4><br>
							<a href="{{route('single.post',$latestPost['id'])}}">
									<img src="{{$latestPost['picture']}}" alt="" class='img-responsive'>
							</a>
							<br>
							<a href="{{route('single.post',$latestPost['id'])}}">
									<h1>{{$latestPost['title']}}</h1>
							</a>
							<p>By : {{$latestPost->User->name}}
							<p>{{substr(strip_tags(ucwords($latestPost['content'])),0,200)}}</p>
							</div>
@endif
<div id="fh5co-main">
<div class='container-fluid' id='scroller_posts'>
			<marquee behavior="scroll" direction="left" scrollamount="10">
						@if($recentPosts)
							@foreach($recentPosts as $post)
							<span id='scrollingPosts'>
									<a href="{{route('single.post',$post['id'])}}">{{$post['title']}}</a>
							</span>	
							@endforeach	
						@endif	
			</marquee>
</div>
<div class='container' id='intro'>
	<div class='row'>
			<div align='center'>
					<h1>Some Title</h1>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum tempora repellat quidem ullam aspernatur aliquam distinctio perspiciatis enim aut dolores porro deleniti, cumque illo sed dicta magni officia quis tenetur!</p>
			</div>
	</div>
</div>
<div class="container-fluid" id='latest_posts_container'>

	<div class="container">
					<div class="row">
							<h1 align='center' id='latest_posts_title'>Latest Posts </h1>
								@if($posts)
									@foreach($posts as $post)
												<div class="col-md-4"  align='center'>
													<img src="{{ $post['picture'] }}" alt="{{ $post['title'] }}" id='post-img' class='img-responsive' width='100%' height='350'>
													<h2>{{ $post['title'] }}</h2>
													<span><small>Author:</small> <a href="{{ route('author.posts',$post['author'])}}">{{ ucfirst($post->User->name) }}</a></span>   |   
													<span><small>Categories:</small> <a href="{{ route('category.posts',strtolower($post->Category->category))}}">{{ $post->Category->category }}</a></span>
													<p><?php echo substr(strip_tags($post['content']),0,250);?></p>
													<p><a href="{{route('single.post',$post['id'])}}" class="btn btn-primary">Read More <?php if(Auth::user()){ echo ucfirst(Auth::user()->name); } ?></a></p>
												</div>
									@endforeach
								@endif
					</div>
	</div>
</div>

		<div id="fh5co-team">
			<div class="container-fluid" id='leaders' align='center'>
				<div class="container">
					<div class="col-md-10 col-md-offset-1">
						<div class="row">
							<h2 class="section-lead text-center">Leadership</h2>
							<div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-staff to-animate">
								<figure>
								<img src="{{ asset('frontend/images/user.jpg') }}" alt="Free HTML5 Template by FREEHTML5.co" class="img-responsive">
								</figure>
								<h3>Will Barrow</h3>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
								<ul class="fh5co-social">
									<li><a href="#"><i class="icon-twitter"></i></a></li>
									<li><a href="#"><i class="icon-github"></i></a></li>
								</ul>
							</div>
							<div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-staff to-animate">
								<figure>
								<img src="{{ asset('frontend/images/user_2.jpg') }}" alt="Free HTML5 Template by FREEHTML5.co" class="img-responsive">
								</figure>
								<h3>Max Conversion</h3>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
								<ul class="fh5co-social">
									<li><a href="#"><i class="icon-twitter"></i></a></li>
									<li><a href="#"><i class="icon-github"></i></a></li>
								</ul>
							</div>
							<div class="clearfix visible-sm-block visible-xs-block"></div>
							<div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-staff to-animate">
								<figure>
								<img src="{{ asset('frontend/images/user_3.jpg') }}" alt="Free HTML5 Template by FREEHTML5.co" class="img-responsive">
								</figure>
								<h3>Hanson Deck</h3>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
								<ul class="fh5co-social">
									<li><a href="#"><i class="icon-twitter"></i></a></li>
									<li><a href="#"><i class="icon-github"></i></a></li>
								</ul>
							</div>
							<div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-staff to-animate">
								<figure>
								<img src="{{ asset('frontend/images/user.jpg') }}" alt="Free HTML5 Template by FREEHTML5.co" class="img-responsive">
								</figure>
								<h3>Sue Shei</h3>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
								<ul class="fh5co-social">
									<li><a href="#"><i class="icon-twitter"></i></a></li>
									<li><a href="#"><i class="icon-github"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
		<div class='row slider_item_text'>
			<div align='center'>
					<h1>Some Title</h1>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum tempora repellat quidem ullam aspernatur aliquam distinctio perspiciatis enim aut dolores porro deleniti, cumque illo sed dicta magni officia quis tenetur!</p>
			</div>
	</div>
    </div>
    <div class="carousel-item">
		<div class='row slider_item_text'>
			<div align='center'>
					<h1>Some Title</h1>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum tempora repellat quidem ullam aspernatur aliquam distinctio perspiciatis enim aut dolores porro deleniti, cumque illo sed dicta magni officia quis tenetur!</p>
			</div>
	</div>
    </div>
    <div class="carousel-item">
		<div class='row slider_item_text'>
			<div align='center'>
					<h1>Some Title</h1>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum tempora repellat quidem ullam aspernatur aliquam distinctio perspiciatis enim aut dolores porro deleniti, cumque illo sed dicta magni officia quis tenetur!</p>
			</div>
	</div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

	</div>

	@endsection
