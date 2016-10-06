<?php
namespace App\Traits;

trait Ruled{
	public function ruled(){
		return $this->belongsToMany('App\Rule','rulables','rule_id');
	}
}
