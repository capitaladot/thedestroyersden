<?php

namespace App\Traits;

/**
 * An item is craftable if it can be produced by a crafting technique.
 *
 * @author U53456
 *        
 */
trait Craftable {
	/**
	 * the crafts with which an Item with the Craftable trait may be produced.
	 */
	public function crafts() {
		return $this->belongsToMany('App\Craft','craft_item','item_id');
	}
	/**
	 */
	public function craftingOccurrence() {
		return $this->belongsToMany ( 'App\CraftingOccurrence','craft_id' );
	}
	public function craftingComponents(){
		return $this->morphedByMany('App\CraftingComponent','requirable','crafting_requirements','requirable_id');
	}
	public function rawResources(){
		return $this->morphedByMany('App\RawResource','requirable','crafting_requirements','requirable_id');
	}
	public function tools(){
		return $this->morphedByMany('App\Tool','requirable','crafting_requirements','reguirable_id');
	}
}