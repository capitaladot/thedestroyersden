@extends('app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">{{ $count }} Search Results for &quot;{{ $terms }} &quot;</div>
			<div class="panel-body">
				@foreach($models as $model)
					@permission($model->permission('read'))
				<div>
					<a href="{!! $model->describable->getUrl() !!}">View the {!! $model->describable->properName() !!} &quot;{!! $model->describable->getAttribute('title') !!}&quot;</a>
				</div>
					@endpermission
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection
