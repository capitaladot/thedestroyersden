<?php

namespace App;

use App\Contracts\FillableContract;
use App\Contracts\RelatableContract;
use App\Traits\Fillable;
use App\Traits\Relatable;
use App\Traits\RoutedById;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Consumable;
use App\PlayerCharacter;

class Consumption extends BaseModel implements FillableContract,RelatableContract,NavigatableContract{
	use Fillable;
	use RoutedById;
	use Relatable;
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
