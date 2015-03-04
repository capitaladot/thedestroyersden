<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Navigatable;
use App\BaseModel;
use App\Arcable;
use App\Fillable;
class Economy extends BaseModel implements NavigatableContract {
	use Navigatable;
	use Fillable;
	use Arcable;
	public $fillable = [
		'buy_factor',
		'sell_factor'
	];
	public $relationMethods = ['arc'];
}