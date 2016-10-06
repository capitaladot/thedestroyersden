<h4>{{ $relationTitle }}+</h4>
<ul>
@foreach($collection as $modelIndex => $eachModel)
	<li>
		<strong>{!! $eachModel->getTitle('title') !!}|</strong>
@if(!$eachModel->order->executed)
		{!! Form::open(['class'=>'form-inline','route'=>[str_singular(str_slug(snake_case('ticket'))).'.destroy',$eachModel->id],'method' => 'DELETE']) !!}<div class="form-group">
			<button type="submit" class="btn" title="Remove from Cart"><i class="fa fa-2xlg fa-cart-arrow-down" aria-hidden="true"></i></button>
		</div>
		{!! Form::close() !!}
@endif
	</li>
@endforeach
</ul>
