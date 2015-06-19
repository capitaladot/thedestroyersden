@extends('app')
@section('content')
 <div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{!! str_plural(studly_case(str_replace('_',' ',snake_case($modelName)))) !!}</div>
				<div class="panel-body">
					<div>
						<button onclick="window.location.replace('/{!! $modelName !!}/create');"
							>Create a new {!! studly_case(str_replace('_',' ',snake_case($modelName))) !!}</button>
					</div>
					@foreach($models as $model)
					<div>
						<a href="/{!! $modelName !!}/{!! $model->id !!}">View {!! $model->getAttribute('title') !!}</a>
						|
						<a href="/{!! $modelName !!}/{!! $model->id !!}/edit">Edit</a>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection