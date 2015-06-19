<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\Navigatable; use App\Traits\Presentable;
use App\BaseModel; use McCool\LaravelAutoPresenter\HasPresenter;

class Craft extends Skill implements NavigatableContract {
	
	use Requireable;
	use Navigatable; use Presentable;
	use Taggable;
	protected $table = 'skills';
	
	/**
	 * the list of final products this technique may produce.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function finalProducts() {
		return $this->hasMany ( 'App\FinalProduct' );
	}
	
	/**
	 * the skill this crafting technique resides under.
	 */
	public function skill() {
		return $this->belongsTo ( 'App\Skill' );
	}
}