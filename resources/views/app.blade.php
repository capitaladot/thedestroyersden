<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ isset($title) ? ($title." | ") : "" }}The Destroyer's Den</title>
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<!-- -->
	<link href="/css/app.css" rel="stylesheet">
	<!-- -->
	<link href="/css/styles.css" rel="stylesheet">
	
	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Raleway:900,800,700,600,500,400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	<link rel="apple-touch-icon-precomposed" href="/images/favico152.png">
	<meta name="msapplication-TileColor" content="#FFFFFF">
	<meta name="msapplication-TileImage" content="/images/favico144.png">
	<!-- For iPad with high-resolution Retina display running iOS ≥ 7: -->
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="/images/favico152.png">

	<!-- For iPad with high-resolution Retina display running iOS ≤ 6: -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/images/favico144.png">

	<!-- For iPhone with high-resolution Retina display running iOS ≥ 7: -->
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="/images/favico120.png">

	<!-- For iPhone with high-resolution Retina display running iOS ≤ 6: -->
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/images/favico114.png">

	<!-- For first- and second-generation iPad: -->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/images/favico72.png">

	<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
	<link rel="apple-touch-icon-precomposed" href="/images/favico57.png">
	<link rel="icon" href="/images/favico32.png" sizes="32x32">
	<link rel="icon" href="/images/favico16.png" sizes="16x16">
</head>
<body>
	<nav class="navbar navbar-center navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span> 
					<span class="icon-bar"></span> 
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/"><img class="img-responsive" src="/images/logoNoSlogan.png" alt="The Destroyer's Den LARP"></a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				{!!  isset($linkPresenter) ? $linkPresenter->render () :'' !!}
				<ul class="nav navbar-nav">
					@if(isset($craftingMenu))
					<li class="dropdown"><a href="#" class="dropdown-toggle" 
						data-toggle="dropdown" role="button" aria-expanded="false">{!! 
							$craftingMenu->properName() !!}<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu">
						
							@permission('create.'. str_plural(str_slug($craftingMenu->properName())) )
							<li><a href="/{{ str_slug($craftingMenu->properName()) }}/create"
								>Create a new {{ $craftingMenu->properName() }}</a>
							</li> @endpermission {!!
							$craftingMenu->render() !!}
						
						</ul>
					</li>
					@endif
					@if(isset($eventMenu))
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown" role="button" aria-expanded="false">{!!
							str_plural($eventMenu->properName()) !!}<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu">
							@permission('create.'. str_plural(str_slug($eventMenu->properName())) )
							<li><a href="/{{ str_slug($eventMenu->properName()) }}/create"
								>Create a new {{ $eventMenu->properName() }}</a>
							</li> @endpermission 
							{!! $eventMenu->render() !!}
						</ul>
					</li>
					@endif
				@if(Auth::check() && isset($menus) && !empty($menus))
					@foreach($menus as $menu)
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown" role="button" aria-expanded="false">{!!
							$menu->properName() !!}<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu">
							@permission('list.'. str_plural(str_slug($menu->properName())) )
							<li><a href="/{{ str_slug($menu->properName()) }}"
								>List of {{ $menu->properName() }}s</a>
							</li>
							@endpermission
							@permission('create.'. str_plural(str_slug($menu->properName())) )
							<li><a href="/{{ str_slug($menu->properName()) }}/create"
								>Create a new {{ $menu->properName() }}</a>
							</li> @endpermission {!!
							$menu->render() !!}
						</ul>
					</li> 
					@endforeach
				@endif
				@if (Auth::guest())
					<li><a href="/auth/login">Login</a></li>					
					<li><a href="/auth/register">Register</a></li> 
				@else
					<li class="dropdown"><a href="#" class="dropdown-toggle" 
						data-toggle="dropdown" role="button" aria-expanded="false">{{
							Auth::user()->name }}
							@if(!empty(Auth::user()->facebook_id))<span title="Logged in with Facebook" class="facebook-button"
							><span></span></span>@endif 
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu">
							@if(!empty(Auth::user()->facebook_id)) 
							<li><a href="/facebook/events">Load Facebook Events</a></li>
							@endif
							<li><a href="/auth/logout">Logout</a></li>
						</ul>
						<li><a href="#" class="dropdown-toggle" 
							data-toggle="dropdown" role="button" aria-expanded="false"
								>Player Characters<span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
							<li><a href="/{{ str_slug($menus->where('name','PlayerCharacter')->first()->properName()) }}/create"
								>Create a new Player Character</a>
							</li>{{ 
							$menus->where('name','PlayerCharacter')->first()->render() 
						}}</ul></li>
					</li>
				@endif
				</ul>
				<div class="pull-right"><a href="http://www.larpunited.com" title="The Destroyer's Den is a member of LARP United.">
					<img src="/images/cropped-cropped-united11.png" alt="The Destroyer's Den is a member of LARP United."
					class="img-responsive" 
				></a></div>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<script
		src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/raleway.js"></script>
</body>
</html>
