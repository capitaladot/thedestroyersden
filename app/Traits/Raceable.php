<?php
namespace App\Traits;
use App\Race;
trait Raceable{
	public function race(){
		return $this->belongsTo('App\Race');
	}
}