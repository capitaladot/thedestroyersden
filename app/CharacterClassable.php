<?php
namespace App;

trait CharacterClassable{
	public function characterClass() {
		return $this->belongsTo ( 'App\CharacterClass' );
	}
}