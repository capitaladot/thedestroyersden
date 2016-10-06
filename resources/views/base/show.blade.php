@extends('app')
@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1><span class="lead">{{studly_case($modelName)}}:&nbsp;</span>{{ $model->getTitle() }}
						@permission('edit.'.$table)
						<span class="lead"><a href="{{ $edit }}">Edit</a></span>
						@endpermission
					</h1>
				</div>
				<div class="panel-body">
					@permission('delete.'.$table)
					{!! Form::open(array('class'=>'form-inline','resource'=>$baseUrl.'.destroy','method' => 'DELETE')) !!}
					{!! Form::submit('Delete '.($model->title ? $model->title : '#'.$model->id),['class'=>'btn btn-primary']) !!}
					{!! Form::close() !!}
					@endpermission
					<ul>
						@foreach($fillables as $input => $properties)
							@if((FALSE !== array_search($properties['columnName'],$model->hidden)) || $properties['columnName'] == 'title' || $properties['columnName'] == 'name')
								{{-- skip; title already displayed. --}}
							@elseif($properties['columnName'] == 'facebook_id')
								<li><strong>{!! $model->{'get'.studly_case($properties['columnName'])}() !!}</strong>
								</li>
							@else
								<li>
									<span class="">{!! ucfirst(str_replace(['_id','_'],['',' '],snake_case($properties['label']))) !!}</span>
									@if(method_exists($model,$properties['columnName'])){!!
							$model->{'get'.studly_case($properties['columnName'])}()
						!!}
									@elseif(method_exists($model,'get'.studly_case($properties['columnName'])))    {!!
							$model->{'get'.studly_case($properties['columnName'])}()
						!!}
									@elseif(is_array($properties['columnName']))
										{-- nothing --}
									@elseif($model[$properties['columnName']] instanceof \DateTime){{
										$model[$properties['columnName']]
									}}
									@else {{
	$model->getAttribute($properties['columnName'])
}}
									@endif</li>
							@endif
						@endforeach
						@foreach($modelSpecific as $eachTitle => $eachModelSpecificDatum)
							@if(!is_array($eachModelSpecificDatum))
								<li><strong>{{ $eachTitle }}</strong>: &nbsp;{!! $eachModelSpecificDatum !!}</li>
							@endif
						@endforeach
						@foreach($relationMethods as $relationIndex => $relationName)
							@if(isset($model->hidden[$relationName]))
								{-- Do nothing --}
							@elseif($model->$relationName() instanceof \Illuminate\Database\Eloquent\Relations\Relation )
								<?php
								$relations = $model->$relationName()->get();
								$relationTitle = is_string($relationIndex)
										? $relationIndex
										: studly_case(str_replace("_", " ", $relationName));
								$relationModel = $model->$relationName()->getRelated();
								$relationClass = class_basename($relationModel);
								?>
								<li>
									@if($relationTitle == "Description" && count($relations->first()))
										{!! $relations->first()->body !!}
									@else
										@include(resolveView($relationModel,'collection'), ['collection'=>$relations,'relationName'=>$relationName,'relationClass'=>$relationClass,'relationTitle'=>$relationTitle])
									@endif
								</li>
							@else
								<?php $relation = $model->$relationName(); \ddd($relationName, $relation);?>
							@endif
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
@endsection
