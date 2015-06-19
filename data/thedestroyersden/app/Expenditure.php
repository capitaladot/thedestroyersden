<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract; use App\Navigatable;
use App\BaseModel;

/**
 */
class Expenditure extends BaseModel implements NavigatableContract {
	use Navigatable;
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