<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract; use App\Navigatable;
use App\BaseModel;

/**
 *
 * @author U53456
 *
 */
class Spell extends BaseModel implements NavigatableContract {
	use Navigatable;
	use Titleable;
	public function skill() {
		return $this->morphOne ( 'App\Skill', 'typeable' );
	}
}