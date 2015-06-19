<?php

namespace App\Traits;

trait CharacterClassable {
	public function characterClass() {
		return $this->belongsTo ( 'App\CharacterClass' );
	}
}