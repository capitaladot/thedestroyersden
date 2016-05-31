@extends('app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1> <span class="lead">{{studly_case($modelName)}}:&nbsp;</span>{{ $model->title or '#'.$model->id }}
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
					@if($properties['columnName'] == 'title' || $properties['columnName'] == 'name')
						{{-- skip; title already displayed. --}}
					@elseif($properties['columnName'] == 'facebook_id')
					<li><h4>{!! $model->{'get'.studly_case($properties['columnName'])}() !!}</h4></li>
					@else
					<li><h4>{!! ucfirst(str_replace(['_id','_'],['',' '],snake_case($properties['label']))) !!}</h4>
						@if(method_exists($model,$properties['columnName'])){!!
							$model->{'get'.studly_case($properties['columnName'])}()
						!!}
						@elseif(method_exists($model,'get'.studly_case($properties['columnName'])))	{!!
							$model->{'get'.studly_case($properties['columnName'])}()
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
				@foreach($relationMethods as $relationIndex => $relationName)
					<?php $relations = $model->$relationName()->get();
						$relationTitle = studly_case(str_replace("_"," ",$relationName));
						$relationClass = class_basename($relations->first());
						$depth = 0;?>
					<li>
					@if($relationTitle == "Description" && count($relations->first()))
						{{$relations->first()->body}}
					@else
						@include('collection', ['collection'=>$relations,'relationName'=>$relationName,'relationClass'=>$relationClass,'relationTitle'=>$relationTitle])
					@endif
					</li>
				@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection
