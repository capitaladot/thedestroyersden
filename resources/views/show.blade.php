@extends('app') @section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					{{studly_case($modelName)}}: {{ $model->title or '#'.$model->id }}
					@permission('edit.'.$table) <a href="{{ $edit }}">Edit {{
						$model->title or '#'.$model->id }}</a> @endpermission
				</div>
				<div class="panel-body">
					<ul>
						@foreach($fillables as $input =>
						$properties)@if(!in_array($input,$hidden))
						<li><span class="label">{!! $properties['label'] !!}: </span>{!!
							$model->getAttribute($properties['columnName']) !!}</li>@endif
						@endforeach @foreach($model->relationMethods as $relation)
						@if($model->$relation instanceof
						Illuminate\Database\Eloquent\Collection &&
						!empty($model->$relation)) @include('collection',['collection' =>
						$model->$relation]) @elseif($model->$relation instanceof
						Illuminate\Database\Eloquent\Model) @include('entity',['model' =>
						$model->$relation,'modelName'=>$relation,'fillables'=>[]]) @endif
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
