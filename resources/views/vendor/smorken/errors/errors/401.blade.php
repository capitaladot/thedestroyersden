@extends($master)
@section('content')
    <div class="exception well">
        <h3>Unauthorized</h3>
        <div class="descr">
            Please login to access this resource.
            @include('smorken/errors::errors._message', ['message' => isset($message) ? $message : null])
        </div>
    </div>
@stop
