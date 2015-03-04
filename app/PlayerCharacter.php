<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Navigatable;
use App\Attendable;
use App\Homelandable;
use App\Raceable;
class PlayerCharacter extends BaseModel implements NavigatableContract {
	use Navigatable;
	use Attendable;
	use Homelandable;
	use CharacterClassable;
	use Raceable;
	public $relationMethods = ['user','possessions','creations','skills','arcs','experiences','expenditures','characterClass','homeland','race'];
	public function user() {
		return $this->belongsTo ( 'App\User' );
	}
	
	/**
	 * The list of items the player character possesses.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function possessions() {
		return $this->morphMany ( 'App\Item', 'ownable' );
	}
	
	/**
	 * The list of items the player character created.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function creations() {
		return $this->morphMany ( 'App\CraftedItem', 'craftable' );
	}
	
	/**
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function skills() {
		return $this->hasMany ( 'App\Skill' );
	}
	public function arcs() {
		return $this->hasMany ( 'App\Arc' );
	}
	public function experiences() {
		return $this->hasMany ( 'App\Experience' );
	}
	public function earnedExperience() {
		return $this->experiences->sum ( function ($eachExperience) {
			return $eachExperience->value;
		} );
	}
	public function expenditures() {
		return $this->hasMany ( 'App\Expenditure' );
	}
	public function unspentExperience() {
		return $this->earnedExperience () - $this->expenditures->sum ( function ($eachexpenditure) {
			return $eachexpenditure->value;
		} );
	}
}