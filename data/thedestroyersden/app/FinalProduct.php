<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\BaseModel;
use App\Navigatable;
use App\Taggable;
use App\Craftable;
use App\Item;
use App\Salvageable;

class FinalProduct extends BaseModel implements NavigatableContract {
	use App\Craftable;
	use App\Item;
	use App\Salvageable;
	use App\Navigatable;
	use App\Taggable;
}