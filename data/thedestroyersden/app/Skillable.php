<?php
namespace App;

trait Skillable{
	public function skill() {
		return $this->belongsTo ( 'App\Skill' );
	}
}