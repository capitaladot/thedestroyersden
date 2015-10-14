@if(!empty($error))
	<div class="alert alert-danger">
		<strong>Whoops!</strong> There were some problems with your input.<br><br>
		<ul>
			<li>{!! $error !!}</li>
		</ul>
	</div>
@endif
	<div class="form-group">
		<label class="col-md-4 control-label" for="captcha">{!! captcha_img() !!}</label>
		<div class="col-md-6">
		{!! Form::text("captcha",'',['class'=>'form-control']) !!}
		</div>
	</div>