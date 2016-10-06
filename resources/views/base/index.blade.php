@extends('app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">{!! str_plural(studly_case(str_replace('_','',snake_case($modelName)))) !!}
				<div>
					@permission('create.'.str_plural(str_slug(snake_case($modelName))))
					<button class="btn btn-primary"
						onclick="window.location.replace('/{!! $baseUrl !!}/create');"
							>Create a new {!! studly_case(str_replace('-','&nbsp;',$modelName)) !!}
					</button>
					@endpermission
				</div>
			</div>
			<div class="panel-body">
				@foreach($models as $model)
				<div>
					<a href="{!! $model->getUrl() !!}">View {!! $model->getAttribute('title') !!}</a>
					@permission('edit.'.str_plural(str_slug(snake_case($modelName))))| <a href="{!! $model->getUrl() !!}/edit">Edit</a>@endpermission
					@permission('delete.'.str_plural(str_slug(snake_case($modelName))))|
					{!! Form::open(['class'=>'form-inline','route'=>[str_singular(str_slug(snake_case($modelName))).'.destroy',$model->id],'method' => 'DELETE']) !!}
					<div class="form-group">
						{!! Form::submit('Delete '. '#'.$model->id,['class'=>'btn btn-primary']) !!}
					</div>
					{!! Form::close() !!}
					@endpermission
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection
