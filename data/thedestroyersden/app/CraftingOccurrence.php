<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract; use App\Navigatable;
use App\BaseModel;
use App\Arcable;
/**
 * Crafting: when, how, from, by, what.
 */
class CraftingOccurrence extends BaseModel implements NavigatableContract {
	use Navigatable;
	use Arcable;
	public $relationMethods = ['arc','craft','usedComponents','producedComponents','creator','items'];
	/**
	 * The specific crafting technique that created this item.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function craft() {
		return $this->belongsTo ( 'App\Craft' );
	}
	
	/**
	 * Those crafting components selected to create this item.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function usedComponents() {
		return $this->hasMany ( 'App\CraftingComponent' );
	}
	/**
	 * Those crafting components produced by this occurrence.
	 */
	public function producedComponents() {
		return $this->hasMany ( 'App\CraftingComponent' );
	}
	/**
	 * which player character did the creating?
	 */
	public function creator() {
		return $this->belongsTo ( 'App\PlayerCharacter', 'creator_id' );
	}
	/**
	 * the items produced on this occurrence; many are possible due to batching.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function items() {
		return $this->morphMany ( 'App\Item', 'craftable' );
	}
}