<?php
namespace App;
trait Raceable{
	public function race(){
		return $this->belongsTo('App\Race');
	}
}