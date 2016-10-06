<?php

namespace App\Traits;

/**
 * An Item is requirable if it can be required by a requisite.
 *
 *
 */
trait Requiring {
	public function requirements(){
		return $this->belongsToMany('App\Requirement','requirables','requirement_id');
	}
}
