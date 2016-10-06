<?php

namespace App;

use App\Contracts\FillableContract;
use App\Contracts\RelatableContract;
use App\Traits\Fillable;
use App\Traits\Relatable;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Traits\Navigatable;
use App\Traits\Presentable;
use McCool\LaravelAutoPresenter\HasPresenter;

class Sale extends BaseModel implements FillableContract, HasPresenter, RelatableContract, RelatableContract {
	use Fillable;
	use Navigatable;
	use Presentable;
	use Relatable;
	public function item() {
		return $this->morphTo ();
	}
	public function seller() {
		return $this->belongsTo ( 'App\PlayerCharacter', 'seller_id' );
	}
	public function buyer() {
		return $this->belongsTo ( 'App\PlayerCharacter', 'buyer_id' );
	}
	public function arc() {
		return $this->belongsTo ( 'App\Arc' );
	}
	public function sale(){
		return $this->morphTo('saleable');
	}
	public function buy(){
		return $this->morphTo('buyable');
	}
}
