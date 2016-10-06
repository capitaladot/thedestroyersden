<strong>{!! $model->note !!}</strong>
<ul>
	<li>{!! $model->street !!}</li>
	<li>{!! $model->city !!}</li>
	<li>{!! $model->state !!}</li>
	<li>{!! $model->post_code !!}</li>
	<li><a title="Map This Address" href="http://maps.google.com/maps/place/{!! $model->note !!}/@{!! $model->lat !!},{!! $model->lng !!},15z">Google Map</a></li>
</ul>
