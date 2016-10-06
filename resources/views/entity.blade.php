<ul>@foreach( $project->toArray() as $key => $value )
<li><strong>{{ $key }}</strong> : {{$value}}</li>
@endforeach</ul>
