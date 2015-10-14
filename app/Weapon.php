<?php

namespace App;

use App\FinalProduct;
use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\Craftable;
use App\Traits\Durable;
use App\Traits\ItemTypeable;
use App\Traits\Navigatable; 
use App\Traits\Presentable;
use App\Traits\Requireable;
use App\Traits\Salvageable;

class Weapon extends FinalProduct implements NavigatableContract {
	use Craftable;
	use Durable;
	use ItemTypeable;
	use Navigatable; 
	use Presentable;
	use Requireable;
	use Salvageable;
	public $fillable = ['*'];
	public $loss_factor = 3;
	public function scope($query){
		return $query->where('item_type_id',ItemType::where('title','Weapon')->first()->id);
	}
}