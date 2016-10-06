<?php

namespace App;

use App\Contracts\FillableContract;
use App\Contracts\RelatableContract;
use App\Traits\Fillable;
use App\Traits\Relatable;
use App\Traits\RoutedById;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;

class RequirementGroup extends BaseModel implements FillableContract, NavigatableContract, RelatableContract  {
	use Fillable;
	use Relatable;
	use RoutedById;
	public $fillable = ['conjunction','sort_order'];
	//relations
	public function requirements(){
		return $this->hasMany("App\Requirement");
	}
}
