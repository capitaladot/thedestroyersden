<a href="#{{$relationTitle}}" data-toggle="collapse" title="Collapse/Expand the {{ $relationTitle }}(s)"><h4>{{ $relationTitle }}
@if(count($collection)>1))s @endif
+</h4></a>
<div id="{{$relationTitle}}" class="collapse">
	<div class="panel-heading">
		<div>
			@permission('create.'.str_plural(str_slug(snake_case($modelName))))
			<button class="btn btn-primary" onclick="window.location.replace('/{!! str_slug($relationClass) !!}/create');"
				>Create a new {{$relationClass}} (as {!! $relationTitle !!})
			</button>
			@endpermission
		</div>
	</div>
	<ul>
@foreach($collection as $modelIndex => $model)
		<li>
			<h5>{!! $model->getTitle('title') !!}</h5>| <a href="{!! $model->getUrl() !!}">View </a>
			@permission('edit.'.str_plural(str_slug(snake_case($modelName))))| <a href="{!! $model->getUrl() !!}/edit">Edit</a>@endpermission
			@permission('delete.'.str_plural(str_slug(snake_case($modelName))))|
			{!! Form::open(['class'=>'inline','route'=>[str_singular(str_slug(snake_case($modelName))).'.destroy',$model->id],'method' => 'DELETE']) !!}<div class="form-group">
				{!! Form::submit('Delete '.($model->title ? $model->title : '#'.$model->id),['class'=>'btn btn-primary']) !!}</div>
			{!! Form::close() !!}
			@endpermission
		</li>
@endforeach
	</ul>
</div>
