<?php

namespace App;

use App\Contracts\FillableContract;
use App\Contracts\RelatableContract;
use App\Traits\Relatable;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Traits\Attendable;
use App\Traits\CharacterClassable;
use App\Traits\Fillable;
use App\Traits\Homelandable;
use App\Traits\Navigatable; 
use App\Traits\Presentable;
use App\Traits\Raceable;
use McCool\LaravelAutoPresenter\HasPresenter;
class PlayerCharacter extends BaseModel implements FillableContract, HasPresenter, NavigatableContract, RelatableContract {
	
	use Attendable;
	use CharacterClassable;
	use Fillable;
	use Homelandable;
	use Navigatable; 
	use Presentable;
	use Raceable;
	use Relatable;
	public $relationMethods = [ 
			'user',
			'craftingOccurrences',
			'experiences',
			'expenditures',
			'characterClass',
			'homeland',
			'race',
			'consumables',
			'durables',
			'craftingComponents',
			'rawResources',
			'tools',
			'weapons',
			'ownables',
			'skills',
			'spells' 
	];
	public function user() {
		return $this->belongsTo ( 'App\User' );
	}
	
	/**
	 * The list of items the player character possesses.
	 */
	public function craftingComponents() {
		return $this->morphedByMany ( 'App\CraftingComponent', 'ownable', 'ownables', 'owner_id' );
	}
	public function rawResources() {
		return $this->morphedByMany ( 'App\RawResource', 'ownable', 'ownables', 'owner_id' );
	}
	public function durables() {
		return $this->morphedByMany ( 'App\Durable', 'ownable', 'ownables', 'owner_id' );
	}
	public function consumables() {
		return $this->morphedByMany ( 'App\Consumable', 'ownable', 'ownables', 'owner_id' );
	}
	public function tools() {
		return $this->morphedByMany ( 'App\Tool', 'ownable', 'ownables', 'owner_id' );
	}
	public function weapons() {
		return $this->morphedByMany ( 'App\Weapon', 'ownable', 'ownables', 'owner_id' );
	}
	public function ownables() {
		return $this->hasMany ( 'App\Ownable', 'owner_id' );
	}
	/**
	 * The list of items the player character created.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function craftingOccurrences() {
		return $this->morphMany ( 'App\CraftingOccurrence', 'craftable' );
	}
	
	/**
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function skills() {
		return $this->hasManyThrough ( 'App\Skill', 'App\Expenditure', 'skill_id', 'id' );
	}
	public function arcs() {
		return $this->hasMany ( 'App\Arc', 'App\Experience' );
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
		return $this->earnedExperience () - $this->expenditures->sum ( function ($eachExpenditure) {
			return $eachExpenditure->value;
		} );
	}
	public function spells() {
		return $this->hasManyThrough ( 'App\Spell', 'App\Memorization', 'spell_id', 'id' );
	}
}
