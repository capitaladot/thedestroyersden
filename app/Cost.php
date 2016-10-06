<?php

namespace App;

use App\Contracts\FillableContract;
use App\Contracts\RelatableContract;
use App\Skill;
use App\Traits\Presentable;
use App\Traits\Relatable;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use McCool\LaravelAutoPresenter\HasPresenter;
use App\Traits\Fillable;
use App\Traits\CharacterClassable;
use App\Traits\Skillable;
use App\Traits\Homelandable;
use App\Traits\Raceable;
use App\ArithmeticOperator;
use App\Traits\Operable;
use App\Traits\RoutedById;

/**
 * Class Cost
 * @package App
 */
class Cost extends BaseModel implements HasPresenter, FillableContract,NavigatableContract,RelatableContract{
	use CharacterClassable;
	use Fillable;
	use Homelandable;
	use Operable;
	use Presentable;
	use Raceable;
	use Relatable;
	use RoutedById;
	use Skillable;
	public $fillable = ['value'];
	public $hidden = ['value'];
	public $relationMethods = ['arithmeticOperator','characterClass','homeland','race','skill'];

	/**
	 * @param $skill \App\Skill
	 * @return mixed
	 */
	public function calculate(Skill $skill){
		return eval("return $skill->value$this->arithmeticOperator->value$this->value;");
	}
	public function getTitle(){
		$title = $this->skill->getTitle();
		if(count($this->race))
			$title = $this->race->getTitle().": ".$title;
		if(count($this->homeland))
			$title = $this->homeland->getTitle().": ".$title;
		return $title;
	}
}
