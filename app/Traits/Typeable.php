<?php

namespace App\Traits;

trait Typeable {
	public function itemTypes() {
		return $this->hasMany ( 'App\ItemType' );
	}
}