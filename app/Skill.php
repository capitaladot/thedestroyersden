<?php

namespace App;

use App\Traits\Ruled;
use McCool\LaravelAutoPresenter\HasPresenter;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Contracts\RelatableContract;
use App\Traits\Deific;
use App\Traits\Fillable;
use App\Traits\Homelandable;
use App\Traits\Magical;
use App\Traits\Navigatable;
use App\Traits\Presentable;
use App\Traits\Raceable;
use App\Traits\Relatable;
use App\Traits\Requirable;
use App\Traits\Requiring;
use App\Traits\SkillTypeable;

class Skill extends BaseModel implements HasPresenter, NavigatableContract, RelatableContract {
	use Deific;
	use Fillable;
	use Homelandable;
	use Magical;
	use Navigatable;
	use Presentable;
	use Raceable;
	use Relatable;
	use Requirable;
	use Requiring;
	use Ruled;
	use SkillTypeable;
	public $appends = ['description'];
	public $fillable = ['level','max_purchases','slug','title'];
	public $hidden = ['title','slug'];
	public $relationMethods = ['characterClasses','costs','deity','homeland','magic','playerCharacters','race','requirements','requirers'];
	public function getDescriptionAttribute(){
		if(!count($this->ruled))
			return "";
		return $this->ruled()->first()->description->first()->body;
	}
	//relations
	public function typeable() {
		return $this->morphTo ();
	}
	public function costs() {
		return $this->hasMany ( 'App\Cost' );
	}
	public function characterClasses(){
		return $this->belongsToMany('App\CharacterClass','costs','skill_id','character_class_id');
	}
	public function playerCharacters(){
		return $this->belongsToMany('App\PlayerCharacter','expenditures','skill_id','player_character_id');
	}
	//scopes
	public function scope($query){
        return $query->with(['characterClasses','costs','deity','description','homeland','magic','race','requirers','requirements']);
    }
}
