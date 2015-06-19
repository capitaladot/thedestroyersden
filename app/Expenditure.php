<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract; use App\Traits\Navigatable; use App\Traits\Presentable;
use App\BaseModel; use McCool\LaravelAutoPresenter\HasPresenter;

/**
 */
class Expenditure extends BaseModel implements HasPresenter, NavigatableContract {
	use Navigatable; use Presentable;
	public function playerCharacter() {
		return $this->belongsTo ( 'App\PlayerCharacter' );
	}
	public function skill() {
		return $this->belongsTo ( 'App\Skill' );
	}
	
	/**
	 * An expenditure of Experience is considered to take place during the
	 * current Arc (if one is ongoing) or the next Arc (if it is not).
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function arc() {
		return $this->belongsTo ( 'App\Arc' );
	}
}