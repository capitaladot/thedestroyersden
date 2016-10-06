<?php

namespace App;

use App\Contracts\FillableContract;
use App\Contracts\RelatableContract;
use App\Traits\Fillable;
use App\Traits\Relatable;
use App\Traits\RoutedById;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Traits\Presentable;
use McCool\LaravelAutoPresenter\HasPresenter;
use App\Cost;
use App\CharacterClass;
use App\Homeland;
use App\PlayerCharacter;
use App\Race;
use App\Skill;

/**
 */
class Expenditure extends BaseModel implements FillableContract, HasPresenter, NavigatableContract,RelatableContract {
	use Fillable;
	use RoutedById;
	use Presentable;
	use Relatable;
	public function value(){
		$costs = Costs::where(['skill_id'=>$this->skill])->get()->sortBy('operation')->filter(function($cost){
			if (
				(
					$cost->characterClass == $this->playerCharacter->characterClass
						||
					is_null($cost->characterClass)
				)
					&&
				(
					$cost->culture == $this->playerCharacter->culture
						||
					is_null($cost->culture)
				)
					&&
				(
					$cost->race == $this->playerCharacter->race
						||
					is_null($cost->race)
				)
			)
				return true;
		});
		$value = 0;
		foreach($costs as $cost){
			if($value == 0 && empty($cost->operation))
				$value = $cost->value;
			else if(!empty ($cost->operation))
				$value = $cost->calculate($value);
		}
		return $value;
	}
	//relations
	public function playerCharacter() {
		return $this->belongsTo ( 'App\PlayerCharacter' );
	}
	public function skill() {
		return $this->belongsTo ( 'App\Skill' );
	}
	
	/**
	 * An expenditure of Experience is considered to take place during the
	 * current Arc (if one is ongoing) or the next Arc (if it is not).
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function arc() {
		return $this->belongsTo ( 'App\Arc' );
	}
}
