<?php

namespace App;

use App\Item;
use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\Harvestable;
use App\Traits\Navigatable; use App\Traits\Presentable;
use App\Traits\Requireable;
use App\Traits\Buyable;
use App\Contracts\ItemContract;

class RawResource extends Item implements ItemContract, NavigatableContract {
	use Buyable;
	use Harvestable;
	use Navigatable; use Presentable;
	use Requireable;
}