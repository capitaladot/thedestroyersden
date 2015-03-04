<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Item;
use App\Navigatable;
use App\Requireable;
use App\BaseModel;
use App\Taggable;
class CraftingComponent extends BaseModel implements NavigatableContract {
	use App\Craftable;
	use App\Item;
	use App\Salvageable;
	use App\Requireable;
	use App\Navigatable;
	use App\Taggable;
}