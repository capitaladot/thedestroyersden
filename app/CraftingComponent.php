<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\Craftable;
use App\Traits\Navigatable; use App\Traits\Presentable;
use App\Traits\Requireable;
use App\Traits\Salvageable;
use App\Traits\Taggable;
use App\Item;
use App\Contracts\ItemContract;

class CraftingComponent extends Item implements ItemContract, NavigatableContract {
	use Craftable;
	use Navigatable; use Presentable;
	use Requireable;
	use Salvageable;
	use Taggable;
}