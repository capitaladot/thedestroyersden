<?php

namespace App;

use App\Contracts\FillableContract;
use McCool\LaravelAutoPresenter\HasPresenter;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Contracts\RelatableContract;
use App\Traits\Describable;
use App\Traits\Fillable;
use App\Traits\Navigatable;
use App\Traits\Presentable;
use App\Traits\Relatable;
use App\Traits\Ruled;

class Deity extends Skill implements FillableContract, HasPresenter, NavigatableContract, RelatableContract {
	use Describable;
	use Fillable;
	use Navigatable;
	use Presentable;
	use Relatable;
	use Ruled;

	public $fillable = ['title','clerical_title','symbols'];
	//relations
	public function skills(){
		return $this->hasMany('App\Skills','skill_id','deities.id');
	}
}
