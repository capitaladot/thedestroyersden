<?php

namespace App;
use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Navigatable;
use App\Requireable;
use App\Craftable;
use App\Item;
use App\Salvageable;
use Sjdaws\Vocal\Vocal;

class Weapon extends BaseModel implements NavigatableContract  {
	use Craftable;
	use Item;
	use Salvageable;
	use Requireable;
	use Titleable;
	public $lossFactor = 3;
}