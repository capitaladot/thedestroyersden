<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract; use App\Navigatable;
use App\BaseModel;

/**
 *
 * @author U53456
 *        
 */
class Experience extends BaseModel implements NavigatableContract {
	use Navigatable;
	public function playerCharacter() {
		return $this->hasOne ( 'App\PlayerCharacter' );
	}
	public function arc() {
		return $this->hasOne ( 'App\Arc' );
	}
}