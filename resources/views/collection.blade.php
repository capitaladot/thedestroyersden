<ul>
	@foreach($collection as $eachEntity)
	<li>
		<ul>
			@foreach($eachEntity->attributesToArray() as $key => $value)
			<li><span class="label">{!! $key !!}:</span> {!! $value !!}</li>
			@endforeach @foreach($eachEntity->relationMethods as $joinedRelation)
			@if($eachEntity->$joinedRelation instanceof
			Illuminate\Database\Eloquent\Model )
			@include('entity',['model'=>$eachEntity->$joinedRelation,
			'modelName'=>$joinedRelation]) @elseif($eachEntity instanceof
			Illuminate\Database\Eloquent\Collection &&
			!empty($eachEntity->$joinedRelation))
			@include('collection',['collection'=>$eachEntity->$joinedRelation])
			@endif @endforeach
		</ul>
	</li> @endforeach
</ul>