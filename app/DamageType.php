<?php namespace App;

use App\Contracts\FillableContract;
use App\Contracts\RelatableContract;
use App\Traits\Fillable;
use App\Traits\Relatable;
use App\Traits\Ruled;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Traits\Navigatable;

class DamageType extends BaseModel implements FillableContract, NavigatableContract, RelatableContract  {
	use Fillable;
	use Navigatable;
	use Relatable;
	use Ruled;
	public function weapons(){
		return $this->belongsToMany('App\Weapon');
	}
}
