<?php
namespace App\Traits;

trait Deific{
	public function deity(){
		return $this->requirements()->where('requirable_type','App\Deity');
	}
}
