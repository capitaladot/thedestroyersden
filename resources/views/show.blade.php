@extends('app') @section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1> <span class="lead">{{studly_case($modelName)}}:</span>{{ $model->title or '#'.$model->id }}
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
							@foreach($relations as $relationIndex => $eachRelation)
								<li><a href="{{ $eachRelation->getUrl() }}">{{ $eachRelation->title }}</a>
								<a href="#{{$relationTitle.$relationIndex}}" data-toggle="collapse" title="Collapse/Expand the {{ $relationTitle }}\"{{$eachRelation->title}}\"">+</a>
									<ul id="{{$relationTitle.$relationIndex}}" class="collapse">@foreach($eachRelation->getAttributes() as $key => $eachAttribute)
								<li>{{$key.": ".$eachAttribute }}</li>@endforeach</ul></li>
							@endforeach
						@endif
							</ul>
						</li>
					@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
