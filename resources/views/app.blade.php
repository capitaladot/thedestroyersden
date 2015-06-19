<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ isset($title) ? ($title." | ") : "" }}The Destroyer's Den</title>

<!-- -->
<link href="/css/app.css" rel="stylesheet">
<!-- -->
<link href="/css/styles.css" rel="stylesheet">
<link href="/css/bootstrap.min.css" rel="stylesheet">
<!-- Fonts -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,300'
	rel='stylesheet' type='text/css'>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/"><img src="/images/logoNoSlogan.png" alt="The Destroyer's Den LARP"></a>
			</div>

			<div class="collapse navbar-collapse"
				id="bs-example-navbar-collapse-1">
				{!! $linkPresenter->render () !!}
				<ul class="nav navbar-nav">
					@if(Auth::check()) @foreach($menus as $menu)
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown" role="button" aria-expanded="false">{!!
							$menu->properName() !!}<span class="caret"></span>
					</a>
						<ul class="dropdown-menu" role="menu">
							@role('admin')
							<li><a href="/{{ str_slug($menu->properName()) }}/create">Create
									a new {{ $menu->properName() }}</a></li> @endrole {!!
							Menu::build ( $menu->id ) !!}
						</ul></li> @endforeach
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown" role="button" aria-expanded="false">{!!
							$userMenu->name !!}<span class="caret"></span>
					</a>
						<ul class="dropdown-menu" role="menu">
							@role('admin')
							<li><a href="/{{ str_slug($menu->properName()) }}/create">Create
									a new {{ $userMenu->properName() }}</a></li> @endrole {!!
							$userMenu->render () !!}
						</ul></li> @endif
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
					<li><a href="/auth/login">Login</a></li>
					<li><a href="{{ $facebook_login_link or '' }}">Login with Facebook</a>
					
					<li><a href="/auth/register">Register</a></li> @else
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown" role="button" aria-expanded="false">{{
							Auth::user()->name }} <span class="caret"></span>
					</a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="/auth/logout">Logout</a></li>
						</ul></li> @endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<script
		src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
</body>
</html>
