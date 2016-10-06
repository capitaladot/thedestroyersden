@extends($master)
@section('content')
    <div class="exception well">
        <h3>Sorry, you don't have access.</h3>
        <div>
            You don't have permission to access the resource you are
            trying to reach.
            @include('smorken/errors::errors._message', ['message' => isset($message) ? $message : null])
        </div>
    </div>
@stop
