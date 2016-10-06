<nav class="navbar navbar-center navbar-default">
	<div class="right-link pull-right"><a href="http://www.larpunited.com" title="The Destroyer's Den is a member of LARP United.">
			<img src="/images/cropped-cropped-united11.png" alt="The Destroyer's Den is a member of LARP United."
			></a></div>
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
					@foreach($menus as $name => $menu)
						<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{!! $name !!}<span class="caret"></span></a>
							{!! $menu !!}
						</li>
					@endforeach
				@endif
				@if(Auth::guest()||!Auth::user()->isAdmin())
						<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Links<span class="caret"></span></a>{!! $linkMenu !!}</li>
				@endif
				@if (Auth::guest())
						<li>{!!  link_to_action("\App\Http\Controllers\Auth\AuthController@getLogin","Login")!!}</li>
						<li>{!!  link_to_action("\App\Http\Controllers\Auth\AuthController@getRegister","Register")!!}</li>
				@else
					@include('loggedin')
				@endif
					<li>{!! Form::open(array('action'=>'\App\Http\Controllers\DescriptionController@search','method' => 'POST','class'=>'form-inline')) !!}
						<div class="form-group">
							{!! Form::text('terms','',['title'=>'Search','class'=>'form-control','required'=>true,'placeholder'=>'Search']) !!}
							<button class="btn" type="submit"><i class="fa fa-2xlg fa-search" aria-hidden="true"></i></button>
						</div>
						{!! Form::close() !!}</li>
				</ul>
			</div>
		</div>
	</div>
</nav>
