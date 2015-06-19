<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract; use App\Traits\Navigatable; use App\Traits\Presentable;
use App\BaseModel; use McCool\LaravelAutoPresenter\HasPresenter;

/**
 * A slot represents a selection of a spell added to a character's spell
 * collection.
 */
class Slot extends BaseModel implements HasPresenter, NavigatableContract {
	use Navigatable; use Presentable;
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