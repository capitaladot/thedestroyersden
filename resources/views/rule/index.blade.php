@extends('app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">{!! str_plural(studly_case(str_replace('_','',snake_case($modelName)))) !!}
				<div>
					@permission('create.'.str_plural(str_slug(snake_case($modelName))))
					<button class="btn btn-primary"
						onclick="window.location.replace('/{!! $baseUrl !!}/create');"
							>Create a new {!! studly_case(str_replace('-','&nbsp;',$modelName)) !!}
					</button>
					@endpermission
				</div>
			</div>
			<div class="panel-body">
		<?php $lastModel = $models->first(); ?>
		@foreach($models as $model)
			@if($model->level==0 && $lastModel->id == $model->id)
				<ol data-level="0">
			@elseif( $lastModel->level > $model->level)
				@for($l=0; $l <  $lastModel->level - $model->level; ++$l)
					</ol>
				@endfor
			@elseif($lastModel->level < $model->level)
				@for($l=0; $l < $model->level - $lastModel->level; ++$l)
					<ol>
				@endfor
			@endif
			@if(count($model->childRules))
					</li>
			@endif
					<li data-level="{!! $model->level !!}">
						<h{{ $model->level+1 }}><a href="{!! $model->getUrl() !!}">{!! $model->getAttribute('title') !!}</a></h{{ $model->level+1 }}>
						@permission('edit.'.str_plural(str_slug(snake_case($modelName))))| <a href="{!! $model->getUrl() !!}/edit">Edit</a>@endpermission
						@permission('delete.'.str_plural(str_slug(snake_case($modelName))))|
						{!! Form::open(['class'=>'form-inline','route'=>[str_singular(str_slug(snake_case($modelName))).'.destroy',$model->id],'method' => 'DELETE']) !!}
						<div class="form-group">
							{!! Form::submit('Delete '. '#'.$model->id,['class'=>'btn btn-primary']) !!}
						</div>
						{!! Form::close() !!}
						@endpermission
					@if(!count($model->childRules))</li>@endif
			<?php $lastModel = $model;?>
		@endforeach
				</ol>
			</div>
		</div>
	</div>
</div>
@endsection
