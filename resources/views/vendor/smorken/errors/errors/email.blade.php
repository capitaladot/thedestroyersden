<div><strong>Exception</strong></div>
<pre>{{ $exception }}</pre>
<hr/>
<div><strong>User</strong></div>
@if ($user)
    <pre>{{ print_r($user->getAttributes()) }}</pre>
@else
    <pre>None</pre>
@endif
<hr/>
<div><strong>$_SERVER</strong></div>
<pre>{{ print_r($_SERVER) }}</pre>
<hr/>
<div><strong>$_REQUEST</strong></div>
<pre>{{ print_r($_REQUEST) }}</pre>
<hr/>
<div><strong>Session</strong></div>
<pre>{{ print_r($session) }}</pre>