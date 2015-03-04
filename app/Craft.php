<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Navigatable;
use App\BaseModel;

class Craft extends BaseModel implements NavigatableContract {
	
	use App\Requireable;
	use Navigatable;
	
	/**
	 * the list of final products this technique may produce.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function finalProducts() {
		return $this->hasMany ( 'App\FinalProduct' );
	}
	
	/**
	 * the skill this crafting technique resides under.
	 */
	public function skill() {
		return $this->belongsTo ( 'App\Skill');
	}
}