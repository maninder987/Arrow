
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Clean &mdash; A free HTML5 Template by FREEHTML5.CO</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="Arrow Empire Best Programming Tutorials For Free" />
	<meta name="author" content="ArrowEmpire" />
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link href="https://fonts.googleapis.com/css?family=B612+Mono|Fjalla+One|Kalam|Pathway+Gothic+One|Righteous|Swanky+and+Moo+Moo&display=swap" rel="stylesheet">

  <!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<!-- Google Webfonts -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,300,100,500' rel='stylesheet' type='text/css'>

	<!-- Animate.css -->
	<link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{{ asset('frontend/css/icomoon.css') }}">
	<!-- Simple Line Icons -->
	<link rel="stylesheet" href="{{ asset('frontend/css/simple-line-icons.css') }}">
	<!-- Theme Style -->
	<link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
	<!-- Modernizr JS -->
	<script src="{{ asset('frontend/js/modernizr-2.6.2.min.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">

	<link rel="stylesheet" href="{{ asset('/custom.css') }}">
	</head>
	<body>

	<header id="fh5co-header" role="banner">

			<div class="pos-f-t">
					<div class="collapse" id="navbarToggleExternalContent" align='center'>
						<div class="bg-dark p-4">
						<div class="input-group mb-3 container">
							<input type="text" class="form-control" id='searchField' data='{{ csrf_token() }}' placeholder="Search Here" aria-label="Recipient's username" aria-describedby="basic-addon2">
						
								<h4 class="outputSearch" align='left'></h4>
							
						</div>
						</div>
					</div>
					
			</div>
	
	<nav class="navbar navbar-default" role="navigation">
			<div class="container">
					<div class="navbar-header">
								<!-- Mobile Toggle Menu Button -->
								<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle visible-xs-block" data-toggle="collapse" data-target="#fh5co-navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
								<a class="navbar-brand" href="/">Arrow Empire</a>
					</div>
					<ul class="nav">
						<li class="nav-item">
							<a class="nav-link active" href="/home">Dashboard</a>
						</li>
						<li class="nav-item"><a href="{{ url('/') }}"><span>Home </span></a></li>
						<li class="nav-item"><a href="{{  route('blog') }}"><span>Blog </span></a></li>
						@guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
								@endguest
								<li>
								<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
									<span class="glyphicon glyphicon-search btn-lg"></span>
								</button>
								</li>
					</ul>			
		</nav>
	</header>
	<!-- END .header -->
	<!-- <div id="fh5co-content"> -->
			@if(Request::is('/'))
						@yield('content')
			@else
			<div class="container">
							<div class="row"  id='wrapper-box'>
							
								<div class="col-md-3 animate-box sidebar " >
									@include('inc.sidebar')
								</div>
								<div class="col-md-9 mainBar">
									@yield('content')
								</div>
							</div>
			</div>
			@endif


	<!-- </div> -->




      <div class="container-fluid" id='features'>
        <div class="container">
          <div class="col-md-10 col-md-offset-1">
            <div class="row">
              <h2 class="section-lead text-center">Features</h2>
              <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-service">
                <div class="fh5co-icon to-animate"><i class="icon-present"></i></div>
                <div class="fh5co-desc">
                  <h3>100% Free</h3>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
                </div>
              </div>
              <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-service">
                <div class="fh5co-icon to-animate"><i class="icon-eye"></i></div>
                <div class="fh5co-desc">
                  <h3>Retina Ready</h3>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
                </div>
              </div>
              <div class="clearfix visible-sm-block visible-xs-block"></div>
              <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-service">
                <div class="fh5co-icon to-animate"><i class="icon-crop"></i></div>
                <div class="fh5co-desc">
                  <h3>Fully Responsive</h3>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
                </div>
              </div>

              <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-service">
                <div class="fh5co-icon to-animate"><i class="icon-speedometer"></i></div>
                <div class="fh5co-desc">
                  <h3>Lightweight</h3>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
                </div>
              </div>
              <div class="clearfix visible-sm-block visible-xs-block"></div>
              <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-service">
                <div class="fh5co-icon to-animate"><i class="icon-heart"></i></div>
                <div class="fh5co-desc">
                  <h3>Made with Love</h3>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
                </div>
              </div>
              <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-service">
                <div class="fh5co-icon to-animate"><i class="icon-umbrella"></i></div>
                <div class="fh5co-desc">
                  <h3>Eco Friendly</h3>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
                </div>
              </div>
              <div class="clearfix visible-sm-block visible-xs-block"></div>
            </div>
          </div>
        </div>
      </div>

  	<footer id="fh5co-footer">
  		<div class="container-fluid">
  			<div class="row container" id='footer_data' >
					<div class="col-md-5 col-sm-6 col-xs-12">
					<ul>
				
						@if($recentPosts)
							@foreach($recentPosts as $post)
							<a href="{{route('single.post',$post['id'])}}"><li>{{$post['title']}}</li></a>
							@endforeach	
						@endif	
						
					</ul>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<ul>
								<a href=""><li>Some text goes here</li></a>
								<a href=""><li>Some text goes here</li></a>
								<a href=""><li>Some text goes here</li></a>
								<a href=""><li>Some text goes here</li></a>
								<a href=""><li>Some text goes here</li></a>
						</ul>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<ul>
								<a href=""><li>Some text goes here</li></a>
								<a href=""><li>Some text goes here</li></a>
								<a href=""><li>Some text goes here</li></a>
								<a href=""><li>Some text goes here</li></a>
								<a href=""><li>Some text goes here</li></a>
						</ul>
					</div>
					
				</div>
				<div class="text-center">
  					<p>&copy All Rights Reserved.</p>
  				</div>
  		</div>
  	</footer>
		<script src="{{ asset('js/app.js') }}"></script>
  	<!-- jQuery -->
  	<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
  	<!-- jQuery Easing -->
  	<script src="{{ asset('frontend/js/jquery.easing.1.3.js') }}"></script>
  	<!-- Bootstrap -->
  	<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
  	<!-- Waypoints -->
  	<script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
  	<!-- Main JS -->
  	<script src="{{ asset('frontend/js/main.js') }}"></script>
		<script src="{{ asset('frontend/js/owl.carousel.js') }}"></script>
	
		<script src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>
		<script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
		</script>
		
		<script type="text/javascript" src="{{ asset('frontend/js/customFrontend.js') }}"></script>
  	</body>
  </html>
