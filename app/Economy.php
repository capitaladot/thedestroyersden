<?php

namespace App;

use App\Contracts\FillableContract;
use App\Contracts\RelatableContract;
use App\Traits\Relatable;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Traits\Navigatable; 
use App\Traits\Presentable;
use App\BaseModel; 
use App\Traits\Arcable;
use App\Traits\Fillable;
use McCool\LaravelAutoPresenter\HasPresenter;
class Economy extends BaseModel implements FillableContract,HasPresenter, NavigatableContract,RelatableContract {
	use Arcable;
	use Fillable;
	use Navigatable;
	use Presentable;
	use Relatable;
	public $fillable = [
		'buy_factor',
		'sell_factor'
	];
	public $relationMethods = ['arc'];
}
