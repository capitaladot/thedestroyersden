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
</li>
@if(Auth::check() && count(Auth::user()->cart))
<li>
	<a href="/order/open" title="Your open order.">
		{{ count(Auth::user()->cart->tickets) }}<i class="fa fa-2xlg fa-ticket" aria-hidden="true"></i><i class="fa fa-2xlg fa-shopping-cart" aria-hidden="true"></i></a>
</li>
	@if(count(Auth::user()->cart->tickets))
<li>
	<a href="{!! action('Payment\SquareController@getCard') !!}" title="Checkout"><i class="fa fa-2xlg fa-credit-card" aria-hidden="true"></i></a>
	@endif
</li>
@endif
