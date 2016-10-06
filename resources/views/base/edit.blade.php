@extends('app') @section('content')
<div class="container-fluid">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">{{studly_case($modelName)}}: {{ (!empty($model->getTitle()) ? $model->getTitle() : '#'.$model->id) }}
				@permission('delete.'.$table)
				{!! Form::open(array('resource'=>$baseUrl.'.destroy','method' => 'DELETE')) !!}
				{!! Form::submit('Delete '.(!empty($model->getTitle()) ? $model->getTitle() : '#'.$model->id),['class'=>'btn btn-primary']) !!}
				{!! Form::close() !!}
				@endpermission
				</div>
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
				<div class="panel-body">
					@foreach($fillables as $input => $properties)
					<div class="form-group">{!! Form::label($properties['label']) !!}
						@if(in_array($properties['inputType'] ,['datetime','timestamp'])) {!!
							Form::marshaledDateTime($input,$properties,$model->getAttribute($properties['columnName'])->toDateTimeString())
						!!}
						@elseif($properties['inputType'] == 'text') {!!
							Form::textarea($input,$model->getAttribute($properties['columnName']),[
								$properties['notNull']
								?	('required')
								: '',
								'maxlength' => $properties['maxLength'],'class'=>'form-control' ])
						!!}
						@else {!!
							Form::input($properties['inputType'],$input,
							$model->getAttribute($properties['columnName']),[
								$properties['notNull']
								?	('required')
								: '',
								'maxlength' => $properties['maxLength'],'class'=>'form-control' ])
						!!}
						@endif</div>
					@endforeach
					@foreach($relationControls as $input => $properties)
					<div class="form-group">
					@if($properties['label'] == 'Description')
					{-- do nothing --}
					@else
						{!! Form::label($properties['label']) !!} {!!
						Form::chosen(isset($properties['columnName']) ?	$properties['columnName'] : $input,
						$properties['options'], [
						!empty($properties['notNull']) ? ('required') : '' ]) !!}
					@endif
					</div>
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
