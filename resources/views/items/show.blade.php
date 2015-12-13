@extends('app') @section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					{{studly_case($modelName)}}: {{ $model->title or '#'.$model->id }}
					@permission('edit.'.$table) <a href="{{ $edit }}">Edit {{
						$model->title or '#'.$model->id }}</a> 
					@endpermission
					@permission('delete.'.$table) 
					{!! Form::open(array('resource'=>$baseUrl.'.destroy','method' => 'DELETE')) !!}
					{!! Form::submit('Delete '.($model->title ? $model->title : '#'.$model->id),['class'=>'btn btn-primary']) !!}
					{!! Form::close() !!}
					@endpermission
				</div>
				<div class="panel-body">
					<ul>
						@foreach($fillables as $input => $properties)
						<li><h4>{!! $properties['label'] !!}</h4>
							@if($properties['inputType'] == 'datetime') {!!
								date ( "Y-m-d\TH:i:s", strtotime ( $model->getAttribute($properties['columnName'] ) ) )
							!!} 
							@elseif($properties['inputType'] == 'text') {!!
								$model->getAttribute($properties['columnName'])
							!!} 
							@elseif(method_exists($model,lcfirst(studly_case($properties['columnName']))))
							{!! 
								call_user_func([&$model, lcfirst(studly_case($properties['columnName']))]);
							!!}
							@else {{ $model->getAttribute($properties['columnName']) 
							}}
							@endif</li> 
						@endforeach
						@foreach($relationControls as $input => $properties)
						<li>{{ $properties['label'] }} {!! $model->{$input}->title !!}</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
