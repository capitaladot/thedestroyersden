<?php
namespace App;

trait Typeable{
	public $type;
	public function typable(){
		return $this->morphTo();
	}
}