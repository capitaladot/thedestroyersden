@extends('app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1> <span class="lead">{{studly_case($modelName)}}:</span>{{ $model->getTitle() }}
					@permission('edit.'.$table) <span class="lead"><a href="{{ $edit }}">Edit {{
					$model->title or '#'.$model->id }}</a></span>
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
					@if($properties['columnName'] == 'title')
					@else
					<li><h4>{!! str_replace(' Id','',$properties['label']) !!}</h4>
						@if(method_exists($model,$properties['columnName'])){!! $model->$properties['columnName']()
					!!}
						@elseif(method_exists($model,'get'.studly_case($properties['columnName'])))	{!! $model->{'get'.studly_case($properties['columnName'])}()
					!!}
						@elseif($model->$properties['columnName'] instanceof \DateTime){{
						$model->$properties['columnName']->format($model::READABLE_DATE)
					}}
						@else {{
						$model->getAttribute($properties['columnName'])
					}}
						@endif</li>
					@endif
				@endforeach
				@foreach($relationMethods as $relation)
					<?php $relations = $model->$relation()->get();
						$relationTitle = studly_case(str_replace("_"," ",$relation));?>
						<li>{{$relationTitle}}<ul>
					@if($relationTitle == "Description" && count($relations->first()))
						{{$relations->first()->body}}
					@else
						@foreach($relationMethods as $relationIndex => $relationName)
							@if($model->$relationName() instanceof \Illuminate\Database\Eloquent\Relations\Relation )
								<?php
								$relations = $model->$relationName()->get();
								$relationTitle = studly_case(str_replace("_"," ",$relationName));
								$wholeClassName = $model->$relationName()->getRelated();
								$relationClass = class_basename($wholeClassName);
								?>
								<li>
									@if($relationTitle == "Description" && count($relations->first()))
										{{$relations->first()->body}}
									@else
										@include(resolveView($relationClass,'collection'), ['collection'=>$relations,'relationName'=>$relationName,'relationClass'=>$relationClass,'relationTitle'=>$relationTitle])
									@endif
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
@endsection
