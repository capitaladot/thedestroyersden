<?php

namespace App\Traits;
use App\PlayerCharacter;

trait Playable{
	public function playerCharacters(){
		return $this->hasMany('App\PlayerCharacter');
	}
}
