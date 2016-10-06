<?php

namespace App;

use App\Contracts\FillableContract;
use App\Traits\Ruled;
use McCool\LaravelAutoPresenter\HasPresenter;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Contracts\RelatableContract;
use App\Traits\Costable;
use App\Traits\Describable;
use App\Traits\Fillable;
use App\Traits\Relatable;
use App\Traits\Navigatable;
use App\Traits\Presentable;
use App\Traits\Requirable;
use App\Traits\Requiring;
use App\Traits\SkillTypeable;

class Spell extends Skill implements FillableContract,HasPresenter,NavigatableContract,RelatableContract {
	use Costable;
	use Describable;
	use Fillable;
	use Navigatable;
	use Presentable;
	use Relatable;
	use Requirable;
	use Requiring;
	use Ruled;
	use SkillTypeable;
	public $table = 'skills';
	public $fillable = ['level','title'];
	public function getForeignKey()
	{
		return 'skill_id';
	}
	public function getManaCost(){
		return $this->level;
	}
	public function getCastTime(){
		switch($this->level){
			case 1:
				return 3;
			case 2:
				return 5;
			case 3:
				return 8;
		}
	}
}
