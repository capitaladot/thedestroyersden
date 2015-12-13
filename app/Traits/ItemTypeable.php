<?php
namespace App\Traits;

use App\ItemType;

trait ItemTypeable{
	public function itemType(){
		return $this->belongsTo('App\ItemType');
	}
}