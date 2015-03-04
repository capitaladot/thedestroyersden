<?php namespace App;
use App\BaseModel;
use MartinBean\MenuBuilder\Contracts\NavigatableContract; use App\Navigatable;

class Tag extends BaseModel implements NavigatableContract {
	public function rawResources(){
		return $this->morphedByMany('App\RawResource', 'taggable');
	}
	public function craftingComponents(){
		return $this->morphedByMany('App\CraftingComponent', 'taggable');
	}
	public function finalProducts(){
		return $this->morphedByMany('App\FinalProduct','taggable');
	}
}