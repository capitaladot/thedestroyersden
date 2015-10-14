@extends('app') @section('content')
{!! ddd($model) !!}
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
							@elseif(method_exists($model,$properties['columnName'])){!! call_user_method($properties['columnName'],$model)
							!!}
							@else {{ $model->getAttribute($properties['columnName']) 
							}}
							@endif</li> 
						@endforeach
						<?php $baseCost = 0; ?>
						@foreach($model->costs as $eachCost)
							<li>
							@if(is_null($eachCost->operation))
								<?php $baseCost = $eachCost->value; ?>
								<h4>Base Cost</h4>
								{{ $eachCost->value }}
							@else
								@if(!empty($eachCost->character_class_id))
									<h5>{!! $eachCost->characterClass->title !!}}</h5>
								@elseif(!empty($eachCost->homeland_id))
									<h5>{!! $eachCost->homeland->title !!}}</h5>
								@elseif(!empty($eachCost->race_id))
									<h5>{!! $eachCost->race->title !!}}</h5>
								@endif
								{!! $eachCost->calculate($baseCost) !!}
							@endif
							</li>
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
