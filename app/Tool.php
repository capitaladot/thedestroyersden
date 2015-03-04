<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract; use App\Navigatable;
use App\Requireable;
use App\Craftable;
use App\Item;
use App\Salvageable;
use App\BaseModel;

class Tool extends BaseModel implements NavigatableContract {
	use App\Craftable;
	use App\Item;
	use App\Salvageable;
	use App\Requireable;
	use Navigatable;
	public $lossFactor = 2;
}