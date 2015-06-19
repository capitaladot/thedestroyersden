<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract; use App\Navigatable;
use App\BaseModel;
use App\Item;
use App\Harvestable;
use App\Requireable;

class RawResource extends BaseModel implements NavigatableContract {
	use App\Item;
	use App\Harvestable;
	use App\Requireable;
	use Navigatable;
	use Titleable;
	public function consume(){
		$this->consumed_at = now();
	}
}