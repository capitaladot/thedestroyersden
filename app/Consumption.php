<?php

namespace App;

use App\BaseModel; use McCool\LaravelAutoPresenter\HasPresenter;
use App\Consumable;
use App\PlayerCharacter;

class Consumption extends BaseModel {
	public $table = 'consumptions';
	public $fillable = [
			'consumed_at'
	];
	public function playerCharacter() {
		return $this->belongsTo ( 'App\PlayerCharacter' );
	}
	public function consumable() {
		return $this->belongsTo ( 'App\Consumable' );
	}
}