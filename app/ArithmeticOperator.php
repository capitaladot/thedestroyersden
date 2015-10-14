<?php namespace App;

use App\BaseModel;
use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\Navigatable;

class ArithmeticOperator extends BaseModel {
	use Navigatable;
	public $table = "arithmetic_operators";

}
