@section('head')
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
@endsection @yield('head')
@section('styles')
		<link href="/css/bootstrap.min.css" rel="stylesheet">
		<link href="/css/app.css" rel="stylesheet">
		<link href="/css/styles.css" rel="stylesheet">
		{{-- Fonts --}}
		<link href="//fonts.googleapis.com/css?family=Raleway:900,800,700,600,500,400,300" rel="stylesheet" type="text/css">
@endsection @yield('styles')
@section('scripts')
	{{-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --}}
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
@endsection @yield('scripts')
@section('title')
		<title>{{ isset($title) ? ($title." | ") : "" }}The Destroyer's Den</title>
@endsection @yield('title')
@section('startbody')
	@include('icons')
	</head>
	<body>
	@include('navbar')
	@include('flash::message')
@endsection @yield('startbody')
	@yield('content')
@section('bodyscripts')
	{{-- Scripts --}}
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		<script src="/js/raleway.js"></script>
@endsection @yield('bodyscripts')
@section('endbody')
	</body>
</html>
@endsection @yield('endbody')
