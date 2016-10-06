<a href="#addresses" data-toggle="collapse" title="Collapse/Expand the Addresses"><strong>Addresses({{ count($collection) }})+</strong></a>
<div id="addresses" class="collapse">
	<ul>
		@foreach($collection as $modelIndex => $model)
			<li>
				@include(resolveView($relationModel,'entity'),compact($modelName,$model))
			</li>
		@endforeach
	</ul>
</div>
