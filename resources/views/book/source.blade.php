@extends('app')
@section('content')
	{!! Form::open(["name"=>"source","action"=>"BookController@postParse","method"=>"POST"]) !!}
		{!! Form::textarea('book') !!}
		{!! Form::submit() !!}
	{!! Form::close() !!}
@endsection
