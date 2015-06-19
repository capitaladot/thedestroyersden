<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\Navigatable; use App\Traits\Presentable;
use App\BaseModel; use McCool\LaravelAutoPresenter\HasPresenter;
use App\Skill;

/**
 *
 * @author U53456
 *        
 */
class Spell extends Skill implements NavigatableContract {
	use Navigatable; use Presentable;
	public function skill() {
		return $this->morphOne ( 'App\Skill', 'typeable' );
	}
}