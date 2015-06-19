<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\Navigatable; use App\Traits\Presentable;
use App\BaseModel; use McCool\LaravelAutoPresenter\HasPresenter;

/**
 *
 * @author U53456
 *        
 */
class Experience extends BaseModel implements HasPresenter, NavigatableContract {
	use Navigatable; 
	use Presentable;
	public function playerCharacter() {
		return $this->hasOne ( 'App\PlayerCharacter' );
	}
	public function arc() {
		return $this->hasOne ( 'App\Arc' );
	}
	public function awarder() {
		return $this->hasOne ( 'App\User', 'awarder_id' );
	}
}