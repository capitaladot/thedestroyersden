<li><span class="label">{!! $modelName !!}:</span>@if($model instanceof
	Illuminate\Database\Eloquent\Collection)
	@include('collection',['model'=>$model,'relation'=>$relation])
	@elseif($model instanceof Illuminate\Database\Eloquent\Model &&
	$relation != $modelName) @include('entity', ['model' =>
	$model->$relation,'modelName'=>$relation,'fillables'=>[]]) @endif</li>