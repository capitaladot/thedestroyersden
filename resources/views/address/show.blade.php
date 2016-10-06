@extends('app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1> <span class="lead">Address:</span>{{ $model->notes }}
				</h1>
			</div>
			<div class="panel-body">
				<strong>{!! $model->notes !!}</strong>
				<ul>
					<li>{!! $model->street !!}</li>
					<li>{!! $model->city !!}</li>
					<li>{!! $model->state !!}</li>
					<li>{!! $model->post_code !!}</li>
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection
