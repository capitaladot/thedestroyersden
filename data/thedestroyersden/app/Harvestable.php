<?php
trait Harvestable {
	public function harvestingTechniques() {
		return $this->hasMany ( 'App\CraftingTechnique' );
	}
}