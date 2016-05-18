<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\BaseModel;
use McCool\LaravelAutoPresenter\HasPresenter;
use App\Traits\Buyable;
use App\Traits\Craftable;
use App\Traits\ItemTypeable;
use App\Traits\Fillable;
use App\Traits\Navigatable;
use App\Traits\Operable;

class Item extends BaseModel implements NavigatableContract  {
	use Buyable;
	use Craftable;
	use Fillable;
	use ItemTypeable;
	use Navigatable;
	use Operable;
	protected $table = 'items';
	/**
	 */
	public function owner() {
		return $this->morphTo ( 'App\Ownable', 'ownable' );
	}
	public function saleable() {
		return $this->morphsTo ();
	}
}