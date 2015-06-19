<?php

namespace App\Traits;

trait Saleable {
	public function buyable() {
		return $this->morphsTo ();
	}
}