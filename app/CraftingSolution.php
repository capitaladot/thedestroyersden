<?php


namespace App;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CraftingSolution
 * @package App
 * @desc represents the set of CraftingRequirements needed to produce a given Item.
 */
class CraftingSolution extends Model
{
	public function item(){
		return $this->hasOne('App\Item');
	}
	public function requirementAlternatives(){
		return $this->hasMany('App\CraftingRequirementAlternative');
	}

}