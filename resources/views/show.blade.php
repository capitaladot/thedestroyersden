@extends('app')
@section('content')
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
							@foreach($relations as $relationIndex => $eachRelation)
							<li>
								@if($depth < 1)
								<a href="#{{$relationTitle.$relationIndex}}" data-toggle="collapse" title="Collapse/Expand the {{ $relationTitle }}&nbsp;{{$eachRelation->title}}">+</a>
								<div id="{{$relationTitle.$relationIndex}}" class="collapse">
									@if(isset ($eachRelation->traits ['App\Traits\Navigatable']))
										@section('content')
										@parent
										@include('show',[
											'depth'=>($depth+1),
											'model'=>$eachRelation,
											'baseUrl'=>$eachRelation->baseUrl(),
											'modelName' => get_class($eachRelation),
											'edit' => $eachRelation->getUrl() . '/edit',
											'table' => $eachRelation->getTable(),
											'hidden' => $eachRelation->getHidden(),
											'fillables' => $eachRelation->getProcessedFillables()->processedFillables,
											'relationControls' => [],
											'relationMethods' => $eachRelation->relationMethods,
											'title' =>$eachRelation->getTitle()
										])@endsection
									@elseif($eachRelation instanceof \App\BaseModel)
										@section('content')
										@parent
										@include('show',[
											'depth'=>($depth+1),
											'model'=>$eachRelation,
											'baseUrl'=>$eachRelation->baseUrl(),
											'modelName' => get_class($eachRelation),
											'edit' => '#',
											'table' => $eachRelation->getTable(),
											'hidden' => $eachRelation->getHidden(),
											'fillables' => $eachRelation->getProcessedFillables()->processedFillables,
											'relationControls' => [],
											'relationMethods' => $eachRelation->relationMethods,
											'title' => get_class($eachRelation) . " #".$eachRelation->id
										])@endsection
										@else{{ $eachRelation->name }}
									@endif
								</div>
								@elseif(isset ($eachRelation->traits ['App\Traits\Navigatable']))
									<a href="{{$eachRelation->getUrl()}}" title="{{$depth}}">{{ $eachRelation->getTitle() }}</a>
								@else
									Depth: {{$depth}}
								@endif
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
