<?php

namespace App;

use App\FinalProduct;
use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\Craftable;
use App\Traits\Durable;
use App\Traits\Navigatable; use App\Traits\Presentable;
use App\Traits\Requireable;
use App\Traits\Salvageable;

class Weapon extends FinalProduct implements NavigatableContract {
	use Craftable;
	use Durable;
	use Navigatable; use Presentable;
	use Requireable;
	use Salvageable;
	public $loss_factor = 3;
}