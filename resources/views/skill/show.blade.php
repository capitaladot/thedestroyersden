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
					<ul><li>{{ $model->description }}</li>
						<?php \ddd($model->ruled->first()); ?>
						@foreach($fillables as $input => $properties)
							@if((FALSE !== array_search($properties['columnName'],$model->hidden)) || $properties['columnName'] == 'title' || $properties['columnName'] == 'name')
								{{-- skip; title already displayed. --}}
							@else
						<li><h4>{!! $properties['label'] !!}</h4>
								@if(in_array($properties['inputType'] ,['datetime','timestamp'])) {!!
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
							@endif
						@endforeach
						<?php $baseCost = 0; ?>
						@if(count($model->costs))
							@foreach($model->costs as $eachCost)
								<li>
								@if(is_null($eachCost->operation))
									<?php $baseCost = $eachCost->value; ?>
									<h4>Base Cost</h4>
									{{ $eachCost->value }}
								@else
									<h5>
									@if(!empty($eachCost->character_class_id))
										{!! $eachCost->characterClass->title !!}}
									@elseif(!empty($eachCost->homeland_id))
										{!! $eachCost->homeland->title !!}}
									@elseif(!empty($eachCost->race_id))
										{!! $eachCost->race->title !!}}
									@endif
									</h5>
									{!! $eachCost->calculate($baseCost) !!}
								@endif
								</li>
							@endforeach
						@endif
						@foreach($relationMethods as $relationIndex => $relationName)
							@if(isset($model->hidden[$relationName]))
								{-- Do nothing --}<!-- hidden {{ $relationName }}-->
							@elseif(
								$model->$relationName()
								instanceof \Illuminate\Database\Eloquent\Relations\Relation
							)
								<?php
								$relations = $model->$relationName()->get();
								$relationTitle = is_string($relationIndex)
										?	$relationIndex
										:	studly_case(str_replace("_"," ",$relationName));
								$relationModel = $model->$relationName()->getRelated();
								$relationClass = class_basename($relationModel);
								?>
								<li>
									@include(resolveView($relationModel,'collection'), ['collection'=>$relations,'relationName'=>$relationName,'relationClass'=>$relationClass,'relationTitle'=>$relationTitle])
								</li>
							@else
								<?php $relation = $model->$relationName(); \ddd($relationName,$relation);?>
							@endif
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
