<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract; use App\Navigatable;
use App\BaseModel;

/**
 * A slot represents a selection of a spell added to a character's spell
 * collection.
 */
class Slot extends BaseModel implements NavigatableContract {
	use Navigatable;
	public function spell() {
		return $this->belongsTo ( 'App\Spell' );
	}
	public function playerCharacter() {
		return $this->belongsTo ( 'App\PlayerCharacter' );
	}
	/*
	 * When was this selected?
	 */
	public function arc() {
		return $this->belongsTo ( 'App\Arc' );
	}
}