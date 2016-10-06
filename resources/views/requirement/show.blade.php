@extends('base.show')
@section('content')
	@parent
	<?php
	$modelSpecific = [];
	$requirer = $model->getRequirer();
	$modelSpecific['Required By'] = View::make(resolveView($requirer,'entity'),['model'=>$requirer,'modelName'=>class_basename($requirer)]);
	$requirement = $model->getRequirement();
	$modelSpecific['Requirement'] = View::make(resolveView($requirement,'entity'),['model'=>$requirement,'modelName'=>class_basename($requirement)]);
	?>
@endsection
