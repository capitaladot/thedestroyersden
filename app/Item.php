<?php

namespace App;

use App\Contracts\FillableContract;
use App\Traits\Ruled;
use McCool\LaravelAutoPresenter\HasPresenter;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Contracts\RelatableContract;
use App\Traits\Owned;
use App\Traits\Presentable;
use App\Traits\Relatable;
use App\Traits\Requirable;
use App\Traits\Requiring;
use App\Traits\Saleable;
use App\Traits\Buyable;
use App\Traits\Craftable;
use App\Traits\ItemTypeable;
use App\Traits\Fillable;
use App\Traits\Navigatable;
use App\Traits\Operable;

class Item extends BaseModel implements FillableContract, HasPresenter, NavigatableContract, RelatableContract  {
	use Buyable;
	use Craftable;
	use Fillable;
	use ItemTypeable;
	use Navigatable;
	use Operable;
	use Owned;
	use Presentable;
	use Relatable;
	use Requirable;
	use Requiring;
	use Ruled;
	use Saleable;
	public $table = 'items';
	//relations
}
