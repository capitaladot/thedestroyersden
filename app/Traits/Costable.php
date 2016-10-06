<?php
namespace App\Traits;
trait Costable{
	public function costs() {
		return $this->hasMany ( 'App\Cost' );
	}
}
