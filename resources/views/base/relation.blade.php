<?php if(!isset($depth)) $depth = 0;?>
<li>
@if($depth <= 1)
	<a href="#{{$relationTitle.$relationIndex}}" data-toggle="collapse" title="Collapse/Expand the {{ $relationTitle }}&nbsp;{{$eachRelation->title}}">+</a>
	<div id="{{$relationTitle.$relationIndex}}" class="collapse">
		@if(isset ($eachRelation->traits ['App\Traits\Navigatable']) && $eachRelation instanceof \App\BaseModel)
		@section('content')
			@appends
			@include('base.show',[
				'depth'=>($depth+1),
				'model'=>$eachRelation,
				'baseUrl'=>$eachRelation->baseUrl(),
				'modelName' => get_class($eachRelation),
				'edit' => $eachRelation->getUrl() . '/edit',
				'table' => $eachRelation->getTable(),
				'hidden' => $eachRelation->getHidden(),
				'fillables' => $eachRelation->getProcessedFillables()->processedFillables,
				'relationControls' => [],
				'relationMethods' => $eachRelation->relationMethods,
				'title' =>$eachRelation->getTitle()
			])
		@endsection
		@elseif($eachRelation instanceof \App\BaseModel)
		@section('content')
			@appends
			@include('base.show',[
				'depth'=>($depth+1),
				'model'=>$eachRelation,
				'baseUrl'=>$eachRelation->baseUrl(),
				'modelName' => get_class($eachRelation),
				'edit' => '#',
				'table' => $eachRelation->getTable(),
				'hidden' => $eachRelation->getHidden(),
				'fillables' => $eachRelation->getProcessedFillables()->processedFillables,
				'relationControls' => [],
				'relationMethods' => $eachRelation->relationMethods,
				'title' => get_class($eachRelation) . " #".$eachRelation->id
			])
		@endsection
		@else {{ isset($eachRelation->name) ? $eachRelation->name : get_class($eachRelation) . " #".$eachRelation->id  }}
		@endif
	</div>
@elseif(isset ($eachRelation->traits ['App\Traits\Navigatable']))
	<a href="{{$eachRelation->getUrl()}}" title="{{$depth}}">{{ $eachRelation->getTitle() }}</a>
@else
	{{isset($eachRelation->name) ? $eachRelation->name : get_class($eachRelation) . " #".$eachRelation->id }}Depth: {{$depth}}
@endif
</li>
