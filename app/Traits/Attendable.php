<?php

namespace App\Traits;
trait Attendable{
	public function arc()
	{
		return $this->morphToMany('App\Arc', 'attendable');
	}
	
}