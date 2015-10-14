<?php

namespace App\Traits;

trait Saleable {
	public function saleable() {
		return $this->morphsTo ();
	}
}