<?php
namespace App;
use MartinBean\MenuBuilder\Contracts\NavigatableContract;

use App\Traits\Describable;
use App\Traits\Fillable;
use App\Traits\Navigatable; 
use App\Traits\Presentable;
use App\Traits\Playable;

use App\BaseModel; 
use McCool\LaravelAutoPresenter\HasPresenter;
use App\Cost;

class Homeland extends BaseModel implements NavigatableContract{
	use Describable;
	use Fillable;
	use Navigatable;
	use Playable; 	
	use Presentable;
	
	public $relationMethods = ['costs','playerCharacters'];
	public function costs(){
		return $this->hasMany('App\Cost');
	}
}