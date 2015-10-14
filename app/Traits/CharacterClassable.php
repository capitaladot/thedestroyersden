<?php

namespace App\Traits;
use App\CharacterClass;
trait CharacterClassable {
	public function characterClass() {
		return $this->belongsTo ( 'App\CharacterClass' );
	}
}