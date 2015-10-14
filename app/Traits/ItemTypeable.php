<?php
namespace App\Traits;

trait ItemTypeable{
	public function itemType(){
		return $this->belongsTo('App\ItemType');
	}
}