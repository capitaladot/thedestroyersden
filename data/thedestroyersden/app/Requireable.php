<?php

namespace App;

/**
 * An item is requireable if it can be required by a crafting requirement.
 *
 * @author U53456
 *        
 */
trait Requireable {
	public function craftingRequirement() {
		return $this->morphToMany ( 'App\CraftingRequirement', 'requireable' );
	}
}