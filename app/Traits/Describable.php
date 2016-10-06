<?php
namespace App\Traits;

use App\Description;

trait Describable{
	public function description(){
        return $this->morphMany('App\Description', 'describable');
	}
}
