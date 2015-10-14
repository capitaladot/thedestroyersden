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
		return $this->belongsToMany ( 'App\Craft' )->withTimestamps();
	}
	/**
	 */
	public function craftingOccurrence() {
		return $this->belongsToMany ( 'App\CraftingOccurrence' );
	}
}