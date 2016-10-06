<?php
namespace App\Traits;

trait Discountable{
	public function discount(){
		return $this->belongsTo('App\Discount');
	}
}
