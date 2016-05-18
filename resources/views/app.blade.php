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
	@include('navbar')

	@yield('content')

	<!-- Scripts -->
	<script
		src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/raleway.js"></script>
</body>
</html>
