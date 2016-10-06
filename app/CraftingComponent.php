<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Traits\Craftable;
use App\Traits\ItemTypeable;
use App\Traits\Navigatable; 
use App\Traits\Presentable;
use App\Traits\Requirable;
use App\Traits\Salvageable;
use App\Traits\Taggable;
use App\Traits\Ruled;

class CraftingComponent extends Consumable implements NavigatableContract {
	use Craftable;
	use ItemTypeable;
	use Navigatable; 
	use Presentable;
	use Requirable;
	use Ruled;
	use Salvageable;
	use Taggable;
	public $fillable = ['*'];
	public function __construct($attributes=[]){
		parent::__construct($attributes);
		$this->itemType()->associate(ItemType::where('title','=','Crafting Component')->first());
	}
	public function newQuery($excludeDeleted = true){
		return parent::newQuery()->where('item_type_id',ItemType::where('title','Crafting Component')->first()->id);
	}
}
