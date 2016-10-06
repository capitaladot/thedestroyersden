<a href="#{{$relationName}}" data-toggle="collapse" title="Collapse/Expand the {{ $relationTitle }}"><strong>{{ $relationTitle }}({{ count($collection) }})+</strong></a>
<div id="{{$relationName}}" class="collapse">
	<div class="panel-heading">
		<div>
			@permission('create.'.str_plural(str_slug(snake_case($modelName))))
			<a href="'/{!! str_slug($relationClass) !!}/create'"
				><button class="btn btn-primary">Create a new {{$relationClass}} (as {!! $relationTitle !!})</button></a>
			@endpermission
		</div>
	</div>
	<ul>
@foreach($collection as $modelIndex => $model)
		<li>
		@include(resolveView($relationModel,'entity'),compact($modelName,$model))
</li>
@endforeach
</ul>
</div>
