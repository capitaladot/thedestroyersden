<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract; use App\Navigatable;
use App\BaseModel;

class Ownership extends BaseModel implements NavigatableContract {
	use Navigatable;
	public function playerCharacter() {
		return $this->morphsByOne ( 'App\PlayerCharacter', 'ownable' );
	}
	public function user() {
		return $this->morphsByOne ( 'App\User', 'ownable' );
	}
}
