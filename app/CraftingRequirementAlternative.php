<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\ItemTypeable;

class CraftingRequirementAlternative extends Model {
	use ItemTypeable;
	public $table = "crafting_requirement_alternatives";
	//relations
	public function craftingRequirements()
	{
		return $this->belongsToMany('App\CraftingRequirements');
	}
}