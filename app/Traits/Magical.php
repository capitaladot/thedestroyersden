<?php

namespace App\Traits;

trait Magical{
	public function magic(){
		return $this->requirements()->where('requirable_type','App\Magic');
	}
}
