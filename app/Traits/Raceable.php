<?php
namespace App\Traits;
trait Raceable{
	public function race(){
		return $this->belongsTo('App\Race');
	}
}