<?php

namespace App;
use App\BaseModel; 
use McCool\LaravelAutoPresenter\HasPresenter;
use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\Navigatable; 
use App\Traits\Presentable;
use App\Traits\Fillable;
use App\Traits\Skillable;

class Skill extends BaseModel implements HasPresenter, NavigatableContract {
	use Navigatable; 
	use Presentable;
	use Fillable;
	use Skillable;
	public $relationMethods = ['costs','prerequisites','characterClasses','playerCharacters'];
	//relations
	public function typeable() {
		return $this->morphTo ();
	}
	public function costs() {
		return $this->belongsTo ( 'App\Cost' );
	}
	public function prerequisites() {
		return $this->hasMany ( 'App\Prerequisite');
	}
	public function characterClasses(){
		return $this->belongsToMany('App\CharacterClass','costs','skill_id','character_class_id');
	}
	public function playerCharacters(){
		return $this->belongsToMany('App\PlayerCharacter','expenditures','skill_id','player_character_id');
	}
	public function scope($query){
        return $query->with(['costs','prerequisites','characterClasses']);
    }
}