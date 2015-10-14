<?php
namespace App\Traits;
use App\Homeland;
trait Homelandable{
	public function homeland(){
		return $this->belongsTo('App\Homeland');
	}
}