<?php
namespace App;
trait Homelandable{
	public function homeland(){
		return $this->belongsTo('App\Homeland');
	}
}