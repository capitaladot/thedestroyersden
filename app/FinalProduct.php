<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Item;
use App\Contracts\ItemContract;
use App\Traits\Craftable;
use App\Traits\Navigatable;
use App\Traits\Presentable;
use App\Traits\Salvageable;
use App\Traits\Taggable;
use App\Traits\Buyable;
use App\Traits\Saleable;

abstract class FinalProduct extends Item implements ItemContract, NavigatableContract {
	use Buyable;
	use Craftable;
	use Navigatable;
	use Presentable;
	use Saleable;
	use Salvageable;
	use Taggable;
}