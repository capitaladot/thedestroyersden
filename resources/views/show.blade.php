@extends('app')
@section('content')
 <div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{studly_case($modelName)}}: {{ $model->title or '#'.$model->id }}</div>
				<div class="panel-body">
					<ul>
						@foreach($fillables as $input => $properties)
						<li>
						{!! $properties['label'] !!}:
						{!! $model->getAttribute($properties['columnName']) !!}
						</li>
						@endforeach
						@foreach($model->relationMethods as $relation)
						<li>
							@if($model->$relation instanceof Illuminate\Database\Eloquent\Collection)
							{!! $relation !!}:
							@foreach($model->$relation as $modelRelation)
							<ul>
								<li>
									<ul>
								@foreach($modelRelation->attributesToArray() as $key=>$value)
										<li>
										{!! $key !!}: {!! $value !!}
										</li>
								@endforeach
								@foreach($modelRelation->relationMethods as $joinedRelation)
									@if(
										$joinedRelation != camel_case($modelName)
											&&
										$joinedRelation != str_plural(camel_case($modelName))
									)
										<li>
										{!! $joinedRelation !!}:{!! $modelRelation->$joinedRelation->getAttribute('title') !!}
										</li>
									@endif
								@endforeach
									</ul>
								</li>
							</ul>
						</li>
							@endforeach
							@endif
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection