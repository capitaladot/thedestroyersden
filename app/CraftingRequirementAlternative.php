<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CraftingRequirements;
class CraftingRequirementAlternative extends Model {

	public $table = "crafting_requirement_alternatives";
	//relations
	public function craftingRequirements(){
		return $this->belongsToMany('App\CraftingRequirements');
	}

}