@extends('base.show')

@section('content')
<?php
	$modelSpecific = [];
	$modelSpecific['Cost Modifier'] = $model->arithmeticOperator->getTitle()." ". $model->value ." to ".$model->skill->getTitle();
?>
	@parent
@show
