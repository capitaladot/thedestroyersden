<?php

namespace App;

use App\Consumable;
use App\Contracts\FillableContract;
use App\Contracts\RelatableContract;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Traits\Harvestable;
use App\Traits\ItemTypeable;
use App\Traits\Navigatable; 
use App\Traits\Presentable;
use App\Traits\Requirable;
use App\Traits\Buyable;
use App\ItemType;

class RawResource extends Consumable implements FillableContract, NavigatableContract, RelatableContract {
	use Buyable;
	use Harvestable;
	use ItemTypeable;
	use Navigatable; 
	use Presentable;
	use Requirable;
	public $fillable = ['*'];
	public function __construct($attributes=[]){
		parent::__construct($attributes);
		$this->itemType()->associate(ItemType::where('title','=','Raw Resource')->first());
	}
	public function newQuery($showDeleted = false){
		return parent::newQuery($showDeleted)->where('item_type_id',ItemType::where('title','Raw Resource')->first()->id);
	}
}
