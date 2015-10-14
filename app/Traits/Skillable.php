<?php
namespace App\Traits;
use App\Skill;

trait Skillable{
	public function skill(){
		return $this->belongsTo('App\Skill');
	}
}