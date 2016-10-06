{{$exception->getMessage()}} at line {{$exception->getline()}} of {{$exception->getFile()}}
Trace: {!! print_r($exception->getTrace()) !!}
