<?php
/**
 * Created by PhpStorm.
 * User: austi_000
 * Date: 6/6/2016
 * Time: 1:09 PM
 */

namespace App;


use App\Contracts\FillableContract;
use App\Contracts\RelatableContract;
use App\Traits\Fillable;
use App\Traits\Navigatable;
use App\Traits\Relatable;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;

class Meal extends BaseModel implements FillableContract,NavigatableContract,RelatableContract
{
	use Fillable;
	use Navigatable;
	use Relatable;
}
