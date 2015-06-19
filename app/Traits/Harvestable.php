<?php

namespace App\Traits;

trait Harvestable {
	public function harvestingTechniques() {
		return $this->hasMany ( 'App\CraftingTechnique' );
	}
}