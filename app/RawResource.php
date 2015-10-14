<?php

namespace App;

use App\Consumable;
use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\Harvestable;
use App\Traits\ItemTypeable;
use App\Traits\Navigatable; 
use App\Traits\Presentable;
use App\Traits\Requireable;
use App\Traits\Buyable;
use App\Contracts\ItemContract;

class RawResource extends Consumable implements ItemContract, NavigatableContract {
	use Buyable;
	use Harvestable;
	use ItemTypeable;
	use Navigatable; 
	use Presentable;
	use Requireable;
	public $fillable = ['*'];
	public function scope($query){
		return $query->where('item_type_id',ItemType::where('title','Raw Resource')->first()->id);
	}
}