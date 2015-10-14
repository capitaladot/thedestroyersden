@extends('app') @section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{!!
					str_plural(studly_case(str_replace('_','
					',snake_case($modelName)))) !!}</div>
				<div class="panel-body">
					@foreach($models as $model)
					<div>
						<a href="{!! $model->getUrl() !!}">View {!!
							$model->getAttribute('title') !!}</a>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
