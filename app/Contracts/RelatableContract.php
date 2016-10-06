<?php

namespace App\Contracts;
use Illuminate\Database\Eloquent\Model;
interface RelatableContract{
	function collectSelections($relationMethods);
	function setSelectedOptions(Array $relatedModel,$selected);
	function attachAttributesToOptions(Model $option, $attributes = []);
	function attachColumnData($relatedModel);
	function attachOptionsAndSelections($namespacedClassName,$relationMethod,$relatedModel);
	function relateBelongsTo($className,$relationMethod,$foreignKey);
	function relateMorph($relationMethod,$className);
	function provideRelatables();
	function attachRequiredRelations($data = []);
}
