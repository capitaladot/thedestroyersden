<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\Craftable;
use App\Traits\ItemTypeable;
use App\Traits\Navigatable; 
use App\Traits\Presentable;
use App\Traits\Requireable;
use App\Traits\Salvageable;
use App\Traits\Taggable;
use App\Consumable;

class CraftingComponent extends Consumable implements NavigatableContract {
	use Craftable;
	use ItemTypeable;
	use Navigatable; 
	use Presentable;
	use Requireable;
	use Salvageable;
	use Taggable;
	public $fillable = ['*'];
	public function scope($query){
		return $query->where('item_type_id',ItemType::where('title','Crafting Component')->first()->id);
	}
}