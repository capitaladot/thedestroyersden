 @extends('app') @section('content')
<div class="container-fluid">
	<div class="row">
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
				Form::open(array('route'=>str_replace('/create','.store',$route->getPath()),'method' => 'POST')) !!}
				<div class="panel-body">
					@foreach($fillables as $input => $properties)
					<div class="form-group">{!! Form::label($properties['label']) !!}
						@if(in_array($properties['inputType'] ,['datetime','timestamp'])) {!!
							Form::marshaledDateTime($input,$properties) !!}
						@elseif($input == 'timezone'){!!
							Form::timezone($input,'',$properties)
						!!}
						@else {!!
							Form::input($properties['inputType'],$input, '',[
						$properties['notNull'] ? ('required') : '', 'maxlength'
						=>$properties['maxLength'] ,'class'=>'form-control']) !!} @endif</div>
					@endforeach
					@foreach($relationControls as $input => $properties)
					<div class="form-group">{!! Form::label($properties['label']) !!} {!!
						Form::chosen(isset($properties['columnName']) ?
						$properties['columnName'] : $input,
						$properties['namespaced']::all(),
						$model->collectSelections($input), [
						!empty($properties['notNull']) ? ('required') : '' ]) !!}</div>
					@endforeach
				</div>
				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						{!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endsection
