<?php namespace App;

use App\BaseModel;
use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\Navigatable;

class DamageType extends BaseModel implements NavigatableContract  {
	use Navigatable;
	public $table ='damage_types';
	public function weapons(){
		return $this->belongsToMany('App\Weapon');
	}
}
