<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Consumption;
use App\Item;
use App\PlayerCharacter;
use App\Traits\Craftable;
use App\Traits\Navigatable; use App\Traits\Presentable;
use App\Traits\Requireable;
use App\Traits\Salvageable;
use App\Traits\Taggable;

class Consumable extends Item implements NavigatableContract {
	use Craftable;
	use Navigatable; use Presentable;
	use Requireable;
	use Salvageable;
	use Taggable;
	protected $table = 'items';
	protected $consumable = true;
	public function consume(PlayerCharacter $consumer) {
		if (count ( $this->consumption ))
			return false;
		$consumption = new Consumption ();
		$consumption->consumer ( $consumer );
		$consumption->consumble ( $this )->save ();
		return true;
	}
	public function consumption() {
		return $this->belongsTo ( 'App\Consumption' );
	}
	public function craftingOccurrence() {
		return $this->belongsTo ( 'App\CraftingOccurrence' );
	}
	public function ownable() {
		return $this->belongsTo ( 'App\Ownable' );
	}
}