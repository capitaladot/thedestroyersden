<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\Navigatable; 
use App\Traits\Presentable;
use App\Traits\Requireable;
use App\Traits\Taggable;
use App\BaseModel; 
use McCool\LaravelAutoPresenter\HasPresenter;

class Craft extends Skill implements NavigatableContract {
	use Navigatable; 
	use Presentable;
	use Requireable;
	use Taggable;
	protected $table = 'skills';
	public $fillable = ['quantity','skill_id','variable'];
	/**
	 * the list of items this technique may produce.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function items() {
		return $this->belongsToMany ( 'App\Item' );
	}
	
	/**
	 * the skill this crafting technique resides under.
	 */
	public function skill() {
		return $this->belongsTo ( 'App\Skill' );
	}
}