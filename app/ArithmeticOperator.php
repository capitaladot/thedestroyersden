<?php namespace App;

use App\Contracts\FillableContract;
use App\Contracts\RelatableContract;
use App\Traits\Fillable;
use App\Traits\Relatable;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Traits\Navigatable;

class ArithmeticOperator extends BaseModel implements FillableContract, NavigatableContract, RelatableContract {
	use Fillable;
	use Navigatable;
	use Relatable;
}
