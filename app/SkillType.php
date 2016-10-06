<?php

namespace App;

use App\Contracts\FillableContract;
use App\Traits\RoutedById;
use McCool\LaravelAutoPresenter\HasPresenter;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Contracts\RelatableContract;
use App\Traits\Describable;
use App\Traits\Fillable;
use App\Traits\Presentable;
use App\Traits\Relatable;


class SkillType extends BaseModel implements HasPresenter, FillableContract, NavigatableContract, RelatableContract{
	use Describable;
	use Fillable;
	use RoutedById;
	use Presentable;
	use Relatable;
	public $fillable = ['model_class'];
	public $hidden = ['model_class'];
	public $relationMethods = ['skills'];
	public function getTitle(){
		return studly_case(str_replace("_"," ",snake_case(class_basename($this->model_class))));

	}
	public function getSlug(){
		return str_slug(class_basename($this->model_class));
	}
	public function  skills(){
		return $this->hasMany("App\Skill");
	}
}
