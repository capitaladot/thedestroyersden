<?php
/**
 * Created by PhpStorm.
 * User: austi_000
 * Date: 6/5/2016
 * Time: 7:45 AM
 */

namespace App;


use App\Contracts\FillableContract;
use App\Contracts\RelatableContract;
use App\Traits\Fillable;
use App\Traits\Navigatable;
use App\Traits\Relatable;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;

class Processor extends BaseModel implements FillableContract, NavigatableContract, RelatableContract
{
	use Fillable;
	use Navigatable;
	use Relatable;
	public function getUrl()
	{
		return "/processor".str_slug($this->getTitle());
	}
}
