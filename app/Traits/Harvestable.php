<?php

namespace App\Traits;

trait Harvestable {
	public function harvestingTechniques() {
		return $this->belongsToMany ( 'App\Craft','harvest_resource' )->withTimestamps();
	}
}