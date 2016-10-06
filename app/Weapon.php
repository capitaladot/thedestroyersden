<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Traits\Craftable;
use App\Traits\ItemTypeable;
use App\Traits\Navigatable; 
use App\Traits\Presentable;
use App\Traits\Requirable;
use App\Traits\Ruled;
use App\Traits\Salvageable;

use App\ItemType;

class Weapon extends Durable implements NavigatableContract {
	use Craftable;
	use ItemTypeable;
	use Navigatable; 
	use Presentable;
	use Requirable;
	use Ruled;
	use Salvageable;
	public $fillable = ['*'];
	public $loss_factor = 3;
	public function __construct($attributes=[]){
		parent::__construct($attributes);
		$this->itemType()->associate(ItemType::where('title','=','Weapon')->first());
	}
}
