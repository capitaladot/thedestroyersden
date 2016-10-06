<?php
/**
 * Created by PhpStorm.
 * User: austi_000
 * Date: 5/30/2016
 * Time: 1:14 PM
 */

namespace App;
use App\Contracts\FillableContract;
use App\Contracts\RelatableContract;
use App\Traits\Describable;
use App\Traits\Fillable;
use App\Traits\Navigatable;
use App\Traits\Relatable;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use McCool\LaravelAutoPresenter\HasPresenter;

class Rule extends BaseModel implements HasPresenter, FillableContract, NavigatableContract, RelatableContract
{
	use Describable;
	use Fillable;
	use Navigatable;
	use Relatable;
	public $appends = ['ruled'];
	public $hidden = ['level','slug'];
	public $fillable = ['level','title'];
	public $relationMethods = [
		'Parent Chapter/Section'=>'parentRule',
		'description',
		'Chapters/Sub-sections'=>'childRules',
		'This rule applies to'=>'ruled'
	];
	public function getPresenterClass(){
		return "App\Presenters\RuleListPresenter";
	}
	//relations
	public function parentRule(){
		return $this->belongsTo('App\Rule','parent_id');
	}
	public function childRules(){
		return $this->hasMany('App\Rule','parent_id');
	}
	public function getRuledAttribute(){
		foreach(['characterClass','craft','deity','homeland','magic','race','skill','spell'] as $name)
			if(count($this->{$name."Ruled"}))
				return $this->{$name."Ruled"}->first();
	}
	public function baseRuled($functionName){
		return $this->morphedByMany("App\\".studly_case(str_replace("Ruled","",$functionName)),'ruled','rulables');
	}
	public function characterClassRuled(){
		return $this->baseRuled(__FUNCTION__);
	}
	public function craftRuled(){
		return $this->baseRuled(__FUNCTION__);
	}
	public function deityRuled(){
		return $this->baseRuled(__FUNCTION__);
	}
	public function homelandRuled(){
		return $this->baseRuled(__FUNCTION__);
	}
	public function magicRuled(){
		return $this->baseRuled(__FUNCTION__);
	}
	public function raceRuled(){
		return $this->baseRuled(__FUNCTION__);
	}
	public function skillRuled(){
		return $this->baseRuled(__FUNCTION__);
	}
	public function spellRuled(){
		return $this->baseRuled(__FUNCTION__);
	}
}
