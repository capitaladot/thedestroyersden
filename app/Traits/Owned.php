<?php
 namespace App\Traits;

 trait Owned{
	 /**
	  * @return mixed
	  */
	 public function owner(){
		 return $this->morphTo('App\Ownable');
	 }
 }
