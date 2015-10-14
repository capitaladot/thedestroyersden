<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\Navigatable; 
use App\Traits\Presentable;
use App\BaseModel; 
use App\Traits\Arcable;
use App\Traits\Fillable;
use McCool\LaravelAutoPresenter\HasPresenter;
class Economy extends BaseModel implements HasPresenter, NavigatableContract {
	use Navigatable; 
	use Presentable;
	use Fillable;
	use Arcable;
	public $fillable = [
		'buy_factor',
		'sell_factor'
	];
	public $relationMethods = ['arc'];
}