<?php
namespace App;
use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\Navigatable; use App\Traits\Presentable;
use App\Traits\Fillable;
use App\BaseModel; use McCool\LaravelAutoPresenter\HasPresenter;
class Homeland extends BaseModel implements NavigatableContract{
	use Navigatable; use Presentable;
	use Fillable;
	public $relationMethods = ['costs','playerCharacters'];
	public function playerCharacters(){
		return $this->hasMany('App\PlayerCharacter');
	}
	public function costs(){
		return $this->hasMany('App\Costs');
	}
}