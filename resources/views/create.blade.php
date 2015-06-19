 @extends('app') @section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{studly_case($modelName)}}</div>
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
					@endif {!!
					Form::open(array('route'=>str_replace('/create','.store',$route->getPath()),
					'method' => 'POST')) !!}
					<ul>
						@foreach($fillables as $input => $properties)
						<li>{!! Form::label($properties['label']) !!}
							@if($properties['inputType'] == 'datetime') {!!
							Form::dateTime($input,$properties) !!} @else {!!
							Form::input($properties['inputType'],$input, '',[
							$properties['notNull'] ? ('required') : '', 'maxlength'
							=>$properties['maxLength'] ]) !!} @endif</li> @endforeach
						@foreach($relationControls as $input => $properties)
						<li>{!! Form::label($properties['label']) !!} {!!
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
