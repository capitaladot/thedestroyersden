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
use App\Contracts\ItemContract;

class Durable extends Item implements ItemContract, NavigatableContract {
	use Craftable;
	use Navigatable; use Presentable;
	use Requireable;
	use Salvageable;
	use Taggable;
	protected $table = 'items';
	protected $consumable = false;
	public function craftingOccurrence() {
		return $this->belongsTo ( 'App\CraftingOccurrence' );
	}
	public function ownable() {
		return $this->belongsTo ( 'App\Ownable' );
	}
}