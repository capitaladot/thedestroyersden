<?php

namespace App\Traits;

/**
 * An Item is requirable if it can be required by a requisite.
 *
 * @author U53456
 *        
 */
trait Requirable {
	public function requirers(){
		return $this->belongsToMany('App\Requirement','requirables','requirement_id');
	}
}
