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
			<div class="left-link">
				<ul class="nav navbar-nav">
				@if(isset($menus) && !empty($menus))
					@foreach($menus as $menu)
						<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{!! $menu->pluralName() !!}<span class="caret"></span></a>
							{!! $menu->render( new \App\Presenters\FormattedUnorderedListPresenter($menu,"dropdown-menu")) !!}
						</li>
					@endforeach
				@endif
				@if(!Auth::user()->isAdmin())
					{!!  isset($linkPresenter) ? $linkPresenter->render () :'' !!}
				@endif
				@if (Auth::guest())
					<li><a href="/auth/login">Login</a></li>
					<li><a href="/auth/register">Register</a></li>
				@else
					@include('loggedin')
				@endif
				</ul>
			</div>
			<div class="right-link pull-right"><a href="http://www.larpunited.com" title="The Destroyer's Den is a member of LARP United.">
				<img src="/images/cropped-cropped-united11.png" alt="The Destroyer's Den is a member of LARP United."
					 class="img-responsive"
				></a></div>
		</div>
	</div>
</nav>
