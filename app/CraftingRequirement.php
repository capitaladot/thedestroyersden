<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract; 
use App\Traits\Navigatable; 
use App\Traits\Presentable;
use App\Traits\Requirable;

use App\BaseModel; 
use McCool\LaravelAutoPresenter\HasPresenter;

class CraftingRequirement extends BaseModel implements HasPresenter, NavigatableContract
{
	use Navigatable;
	use Presentable;
	use Requirable;
	protected $table = 'crafting_requirements';
	public $timestamps = true;
	protected $dates = [
		'deleted_at'
	];
	public function crafts(){
		return $this->hasMany('App\Craft');
	}
	public function craftingRequireMentAlternatives()
	{
		return $this->morphedByMany('App\CraftingRequirementAlternative');
	}
	public function requirables()
	{
		return $this->morphToMany('App\Requirable', 'requirable');
	}
}
