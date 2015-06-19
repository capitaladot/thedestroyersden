<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract; use App\Navigatable;
use App\BaseModel;

class Sale extends BaseModel implements NavigatableContract {
	use Navigatable;
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