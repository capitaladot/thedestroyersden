<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\BaseModel;
use McCool\LaravelAutoPresenter\HasPresenter;
use App\Contracts\ItemContract;
use App\Traits\Craftable;
use App\Traits\Navigatable;
use App\Traits\Fillable;
use App\Traits\Operable;

class Item extends BaseModel implements ItemContract,NavigatableContract  {
	use Craftable;
	use Fillable;
	use Navigatable;
	use Operable;
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
	public function itemType() {
		return $this->belongsTo ( 'App\ItemType' );
	}
}