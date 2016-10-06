<a href="#{{$relationTitle}}" data-toggle="collapse" title="Collapse/Expand the {{ $relationTitle }}"><h4>{{ $relationTitle }}+</h4></a>
@permission('create.order')
{!! Form::open(['route'=>[str_singular(str_slug(snake_case('ticket'))).'.store'],'method' => 'POST','class'=>'form-inline']) !!}<div class="form-group">
	{!! Form::chosen('arc[]', $collection,$collection->pluck('id')->toArray(), ['class'=>'hiddenSelect','multiple'=>'multiple']) !!}
	{!! Form::hidden('order_id',Auth::user()->cart->id) !!}
	{!! Form::submit('Add a Ticket to all Arcs in this Event to your Cart. ',['class'=>'form-control btn btn-primary']) !!}</div>
{!! Form::close() !!}
@endpermission
<div id="{{$relationTitle}}" class="collapse">
	<div class="panel-heading">
		<div>
			@permission('create.'.str_plural(str_slug(snake_case($modelName))))
			<a href="'/{!! str_slug($relationClass) !!}/create'"><button class="btn btn-primary"
				>Create a new {{$relationClass}} (as {!! $relationTitle !!})</button></a>
			@endpermission
		</div>
	</div>
	<ul>
@foreach($collection as $modelIndex => $collectionModel)
		<li>
			<strong>{!! $collectionModel->getTitle('title') !!}|
			@permission('create.order')
				{!! Form::open(['class'=>'form-inline','route'=>[str_singular(str_slug(snake_case('ticket'))).'.store'],'method' => 'POST']) !!}<div class="form-group">
				{!! Form::chosen('arc', [$collectionModel],	[$collectionModel->id], ['class'=>'hiddenSelect']) !!}
				{!! Form::hidden('order_id',Auth::user()->cart->id) !!}
				{!! Form::submit('Add a Ticket to this Arc to your Cart. ',['class'=>'btn btn-primary']) !!}</div>
			{!! Form::close() !!}</strong>
			@endpermission
			@permission($collectionModel->permission('edit'))| <a href="{!! $model->getUrl() !!}/edit"><button class="btn btn-primary">Edit</button></a>@endpermission
			@permission($collectionModel->permission('delete'))|
			{!! Form::open(['class'=>'form-inline','route'=>[str_singular(str_slug(snake_case($modelName))).'.destroy',$collectionModel->id],'method' => 'DELETE']) !!}<div class="form-group">
				{!! Form::submit('Delete '.($collectionModel->title ? $collectionModel->title : '#'.$collectionModel->id),['class'=>'btn btn-primary']) !!}</div>
			{!! Form::close() !!}
			@endpermission
		</li>
@endforeach
	</ul>
</div>
