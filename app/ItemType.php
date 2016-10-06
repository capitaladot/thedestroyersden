<?php

namespace App;
use App\Contracts\RelatableContract;

use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Traits\Fillable;
use App\Traits\Navigatable;
use App\Traits\Relatable;
use App\Traits\Ruled;

class ItemType extends BaseModel implements NavigatableContract, RelatableContract{
	use Fillable;
	use Navigatable;
	use Relatable;
	use Ruled;

	protected $table = 'item_types';
}
