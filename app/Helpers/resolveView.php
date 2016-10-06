<?php

/**
 * @param \Illuminate\Database\Eloquent\Model $model
 * @param $viewName
 * @return string
 */
function resolveView(\Illuminate\Database\Eloquent\Model $model,$viewName){
	$returnValue = (method_exists($model,'baseUrl') === true && view()->exists($model::baseUrl() .".". $viewName)
		?	($model::baseUrl() .".". $viewName)
		:  	(($model instanceof App\BaseModel) === true && view()->exists('base.'.$viewName)
				? 	('base.'.$viewName)
				:
				(view()->exists(strtolower(str_singular(class_basename($model))).".".$viewName)
					?	(strtolower(str_singular(class_basename($model))).".".$viewName)
					:	$viewName
				)));
	return $returnValue;
}
