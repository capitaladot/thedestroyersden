<?php

namespace App;

use App\Contracts\FillableContract;
use App\Traits\Fillable;
use App\Traits\Relatable;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\BaseModel; use McCool\LaravelAutoPresenter\HasPresenter;
use App\Traits\Arcable;
use App\Traits\RoutedById;
use App\Traits\Presentable;

/**
 * Crafting: when, how, from, by, what.
 */
class CraftingOccurrence extends BaseModel implements FillableContract,HasPresenter, NavigatableContract {
	
	use Arcable;
	use Fillable;
	use RoutedById;
	use Presentable;
	use Relatable;
	public $relationMethods = [ 
			'arc',
			'craft',
			'usedComponents',
			'producedComponents',
			'creator',
			'items' 
	];
	/**
	 * The specific crafting technique that created this item.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function craftingSolution() {
		return $this->belongsTo ( 'App\CraftingSolution' );
	}
	
	/**
	 * Those crafting components selected to create this item.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function tools() {
		return $this->belongsToMany ( 'App\Item','crafting_occurrences_tools','crafting_occurrence_id','item_id' );
	}
	public function consumptions(){
		return $this->belongsToMany('App\Consumption');
	}
	public function consumedItems(){
		return $this->hasManyThrough('App\Item','App\Consumption');
	}
	/**
	 * the items produced on this occurrence; many are possible due to batching.
	 */
	public function craftedItems() {
		return $this->belongsToMany ( 'App\Item','crafting_occurrences_crafted_items','crafting_occurrence_id','item_id' );
	}
	/**
	 * which player character did the creating?
	 */
	public function creator() {
		return $this->belongsTo ( 'App\PlayerCharacter', 'creator_id' );
	}

}
