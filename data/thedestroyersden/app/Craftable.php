<?php

namespace App;

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
		return $this->hasMany ( 'App\Crafts' );
	}
	/**
	 */
	public function craftingOccurrence() {
		return $this->hasOne ( 'App\CraftingOccurrence' );
	}
}