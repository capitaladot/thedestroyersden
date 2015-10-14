<?php
namespace App\Traits;

trait Operable{
	public function arithmeticOperator(){
		return $this->belongsTo('App\ArithmeticOperator');
	}
}