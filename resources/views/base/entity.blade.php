<strong>{!! $model->getTitle('title') !!}</strong>| <a href="{!! $model->getUrl() !!}">View </a>
@permission('edit.'.str_plural(str_slug(snake_case($modelName))))| <a href="{!! $model->getUrl() !!}/edit">Edit</a>@endpermission
@permission('delete.'.str_plural(str_slug(snake_case($modelName))))|
{!! Form::open(['class'=>'form-inline','route'=>[str_singular(str_slug(snake_case($modelName))).'.destroy',$model->id],'method' => 'DELETE']) !!}<div class="form-group">
	{!! Form::submit('Delete '.($model->title ? $model->title : '#'.$model->id),['class'=>'btn btn-primary']) !!}</div>
{!! Form::close() !!}
@endpermission
