<?php

namespace App;

use App\Contracts\FillableContract;
use App\Contracts\RelatableContract;
use App\Traits\Describable;
use App\Traits\Relatable;
use App\Traits\Ruled;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use McCool\LaravelAutoPresenter\HasPresenter;
use App\Traits\Costable;
use App\Traits\Fillable;
use App\Traits\Playable;
use App\Traits\Navigatable; 
use App\Traits\Presentable;

use App\BaseModel;
use App\Cost;

class Race extends BaseModel implements HasPresenter, FillableContract, NavigatableContract, RelatableContract {
	use Costable;
	use Describable;
	use Fillable;
	use Navigatable; 
	use Presentable;
	use Playable;
	use Relatable;
	use Ruled;
	public $relationMethods = [ 
			'costs',
			'description',
			'playerCharacters' 
	];
	public $fillables = ['title'];
}
