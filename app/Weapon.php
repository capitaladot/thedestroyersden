<?php

namespace App;

use App\FinalProduct;
use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\Craftable;
use App\Traits\Durable;
use App\Traits\ItemTypeable;
use App\Traits\Navigatable; 
use App\Traits\Presentable;
use App\Traits\Requirable;
use App\Traits\Salvageable;

use App\ItemType;

class Weapon extends FinalProduct implements NavigatableContract {
	use Craftable;
	use Durable;
	use ItemTypeable;
	use Navigatable; 
	use Presentable;
	use Requirable;
	use Salvageable;
	public $fillable = ['*'];
	public $loss_factor = 3;
	public function __construct($attributes=[]){
		parent::__construct($attributes);
		$this->itemType = ItemType::where('title','Weapon')->first();
	}
	public function newQuery($excludeDeleted = true){
		return parent::newQuery()->where('item_type_id',ItemType::where('title','Weapon')->first()->id);
	}
}