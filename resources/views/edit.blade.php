@extends('app') @section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{studly_case($modelName)}}: {{
					($model->getAttribute('title') ? $model->getAttribute('title') :
					'#'.$model->id) }}</div>
				<div class="panel-body">
					@if (count($errors) > 0)
					<div class="alert alert-danger">
						<strong>Whoops!</strong> There were some problems with your input.<br>
						<br>
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li> @endforeach
						</ul>
					</div>
					@endif {!! Form::model($model,['route' =>
					[strtolower($modelName).'.update', $model->id], 'method' => 'PUT'])
					!!}
					<ul>
						@foreach($fillables as $input => $properties)
						<li>{!! Form::label($properties['label']) !!}
							@if($properties['inputType'] == 'datetime') {!!
							Form::dateTime($input,$properties,$model->getAttribute($properties['columnName']))
							!!} @elseif($properties['inputType'] == 'text') {!!
							Form::textarea($input,$model->getAttribute($properties['columnName']))
							!!} @else {!! Form::input($properties['inputType'],$input,
							$model->getAttribute($properties['columnName']),[
							$properties['notNull'] ? ('required') : '', 'maxlength'
							=>$properties['maxLength'] ]) !!} @endif</li> @endforeach
						@foreach($relationControls as $input => $properties)
						<li>{!!
							Debugbar::info($input,$model->$input->lists('id','title'),$model)
							!!} {!! Form::label($properties['label']) !!} {!!
							Form::chosen(isset($properties['columnName']) ?
							$properties['columnName'] : $input,
							$properties['namespaced']::all(),
							$model->collectSelections($input), [
							!empty($properties['notNull']) ? ('required') : '' ]) !!}</li>
						@endforeach
					</ul>
					{!! Form::submit() !!} {!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
