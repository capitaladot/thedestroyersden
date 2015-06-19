@extends('app') @section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{!!
					str_plural(studly_case(str_replace('_','
					',snake_case($modelName)))) !!}</div>
				<div class="panel-body">
					<div>
						@permission('edit.'.snake_case($modelName))
						<button
							onclick="window.location.replace('/{!! $route->getPath() !!}/create');">Create
							a new {!!
							studly_case(str_replace('-','&nbsp;',$route->getPath())) !!}</button>
						@endpermission
					</div>
					@foreach($models as $model)
					<div>
						<a href="{!! $model->getUrl() !!}">View {!!
							$model->getAttribute('title') !!}</a>
						@permission('edit.'.snake_case($modelName))| <a
							href="{!! $model->getUrl() !!}/edit">Edit</a>@endpermission
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
