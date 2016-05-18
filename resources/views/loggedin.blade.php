@yield('login')
<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span title="id:{{ Auth::user()->id }}, role: {{ Auth::user()->getRoles()->first()->name }}">{{ Auth::user()->name }}</span>
		@if(!empty(Auth::user()->facebook_id))<span title="Logged in with Facebook" class="facebook-button"
		><span></span></span>@endif
		<span class="caret"></span>
	</a>
	<ul class="dropdown-menu" role="menu">
		@if(!empty(Auth::user()->facebook_id) && Auth::user()->is('admin'))
			<li><a href="/facebook/events">Load Facebook Events</a></li>
		@endif
		<li><a href="/auth/logout">Logout</a></li>
	</ul>
