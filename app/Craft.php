<?php

namespace App;

use App\Traits\Ruled;
use McCool\LaravelAutoPresenter\HasPresenter;
use App\Contracts\FillableContract;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Contracts\RelatableContract;
use App\Traits\Fillable;
use App\Traits\Navigatable;
use App\Traits\Presentable;
use App\Traits\Requirable;
use App\Traits\Requiring;
use App\Traits\SkillTypeable;


class Craft extends Skill implements FillableContract, HasPresenter, NavigatableContract, RelatableContract {
	use Fillable;
	use Navigatable;
	use Presentable;
	use Requirable;
	use Requiring;
	use Ruled;
	use SkillTypeable;
	protected $table = 'skills';
	public $fillable = ['title'];
	public function getForeignKey()
	{
		return 'skill_id';
	}
}
