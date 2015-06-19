<?php

namespace App;

use App\BaseModel;
use McCool\LaravelAutoPresenter\HasPresenter;
use App\Contracts\ItemContract;

abstract class Item extends BaseModel implements ItemContract {
	protected $table = 'items';
	/**
	 */
	public function owner() {
		return $this->morphTo ( 'App\Ownable', 'ownable' );
	}
	/**
	 * Return either a pegged price or the recursive summation of the tools and
	 * components used in crafting the item.
	 *
	 * @param string $transactionType
	 *        	'buy'|'sell'
	 * @return number
	 */
	public function saleable() {
		return $this->morphsTo ();
	}
	public function itemTypes() {
		return $this->hasMany ( 'App\ItemType' );
	}
}