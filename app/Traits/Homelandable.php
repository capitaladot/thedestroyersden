<?php
namespace App\Traits;
trait Homelandable{
	public function homeland(){
		return $this->belongsTo('App\Homeland');
	}
}