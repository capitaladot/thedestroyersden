<?php

namespace App;
trait Attendable{
	public function arc()
	{
		return $this->morphToMany('App\Arc', 'attendable');
	}
	
}