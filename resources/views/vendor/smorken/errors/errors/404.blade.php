@extends($master)
@section('content')
    <div class="exception well">
        <h3>I don't know where to find that.</h3>
        <div class="descr">
            The resource you were trying to reach doesn't appear to exist.
            @include('smorken/errors::errors._message', ['message' => isset($message) ? $message : null])
        </div>
    </div>
@stop
