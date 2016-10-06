<?php

namespace App;

use App\Contracts\FillableContract;
use App\Contracts\RelatableContract;
use App\Traits\Fillable;
use App\Traits\Relatable;
use App\Traits\RoutedById;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;

class Requirement extends BaseModel implements FillableContract, NavigatableContract, RelatableContract  {
	use Fillable;
	use Relatable;
	use RoutedById;
	public $fillable = ['quantity','variable','group_id','group_conjunction','group_order','requirement','requirer'];
	public function getRequirement(){
		foreach(['characterClass','craft','deity','homeland','magic','race','skill','spell'] as $name)
			if(count($this->{$name."Requirement"}))
				return $this->{$name."Requirement"}->first();
	}
	public function getRequirer(){
		foreach(['characterClass','craft','deity','homeland','magic','race','skill','spell'] as $name)
			if(count($this->{$name."Requirer"}))
				return $this->{$name."Requirer"}->first();
	}
	public function requirementGroup(){
		return $this->belongsTo("App\RequirementGroup");
	}
	public function baseRequirement($functionName){
		return $this->morphedByMany("App\\".studly_case(str_replace("Requirement","",$functionName)),'requirable','requirables','requirement_id','requirable_id');
	}
	public function characterClassRequirement(){
		return $this->baseRequirement(__FUNCTION__);
	}
	public function craftRequirement(){
		return $this->baseRequirement(__FUNCTION__);
	}
	public function deityRequirement(){
		return $this->baseRequirement(__FUNCTION__);
	}
	public function homelandRequirement(){
		return $this->baseRequirement(__FUNCTION__);
	}
	public function magicRequirement(){
		return $this->baseRequirement(__FUNCTION__);
	}
	public function raceRequirement(){
		return $this->baseRequirement(__FUNCTION__);
	}
	public function skillRequirement(){
		return $this->baseRequirement(__FUNCTION__);
	}
	public function spellRequirement(){
		return $this->baseRequirement(__FUNCTION__);
	}
	public function baseRequirer($functionName){
		return $this->morphedByMany("App\\".studly_case(str_replace("Requirer","",$functionName)),'requirer','requirables','requirable_id','requirer_id');
	}
	public function characterClassRequirer(){
		return $this->baseRequirer(__FUNCTION__);
	}
	public function craftRequirer(){
		return $this->baseRequirer(__FUNCTION__);
	}
	public function deityRequirer(){
		return $this->baseRequirer(__FUNCTION__);
	}
	public function homelandRequirer(){
		return $this->baseRequirer(__FUNCTION__);
	}
	public function magicRequirer(){
		return $this->baseRequirer(__FUNCTION__);
	}
	public function raceRequirer(){
		return $this->baseRequirer(__FUNCTION__);
	}
	public function skillRequirer(){
		return $this->baseRequirer(__FUNCTION__);
	}
	public function spellRequirer(){
		return $this->baseRequirer(__FUNCTION__);
	}
}
