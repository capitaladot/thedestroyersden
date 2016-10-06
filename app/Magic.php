<?php

namespace App;

use App\Contracts\FillableContract;
use App\Traits\Requirable;
use App\Traits\Requiring;
use App\Traits\Ruled;
use McCool\LaravelAutoPresenter\HasPresenter;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Contracts\RelatableContract;
use App\Traits\Describable;
use App\Traits\Fillable;
use App\Traits\Navigatable;
use App\Traits\Presentable;
use App\Traits\Relatable;

class Magic extends Skill implements FillableContract, HasPresenter, NavigatableContract, RelatableContract {
	use Describable;
	use Fillable;
	use Navigatable;
	use Presentable;
	use Relatable;
	use Requiring;
	use Requirable;
	use Ruled;
	public $table = 'magics';
	public $fillable = ['title'];
	//relations
	public function costs(){
		return $this->hasMany ( 'App\Cost','skill_id')
			->join('skills','costs.skill_id','=','skills.id')
			->where('skills.title','Conjuration');
	}
	public function magic(){
		return $this->belongsTo('App\Magic','id');
	}
	public function spells(){
		return $this->requiring()->where('requirable_type','App\Magic');
	}
}
