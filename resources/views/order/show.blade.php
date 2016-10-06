@extends('base.show')

@section('content')
<?php
	$modelSpecific = [];
	$modelSpecific['Total'] = "\$".$model->currentTotal();
	if(!$model->executed && count($model->tickets)){
		$modelSpecific['Checkout'] ='<a href="'. action('Payment\SquareController@getCard').'" title="checkout."><i class="fa fa-2xlg fa-credit-card" aria-hidden="true"></i></a>';
$modelSpecific['Empty Cart'] =Form::open(['route'=>['order.destroy',$model],'method' => 'DELETE','class'=>'form-inline']).
		'<div class="form-group">'.
 			'<button type="submit" class="btn" title="Empty Cart"><i class="fa fa-2xlg fa-cart-arrow-down" aria-hidden="true"></i></button>'
		.'</div>'.
 Form::close();
	}
?>
	@parent
@show
