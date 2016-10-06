<?php
namespace App;
use App\Contracts\FillableContract;
use App\Contracts\RelatableContract;
use App\Traits\Relatable;
use App\Traits\Ruled;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;

use App\Traits\Describable;
use App\Traits\Fillable;
use App\Traits\Navigatable; 
use App\Traits\Presentable;
use App\Traits\Playable;

use McCool\LaravelAutoPresenter\HasPresenter;
use App\Cost;

class Homeland extends BaseModel implements FillableContract, NavigatableContract, RelatableContract{
	use Describable;
	use Fillable;
	use Navigatable;
	use Playable;
	use Presentable;
	use Relatable;
	use Ruled;
	public $relationMethods = ['costs','description','playerCharacters'];
	public function costs(){
		return $this->hasMany('App\Cost');
	}
}
