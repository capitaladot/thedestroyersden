<?php

namespace App;

use App\Traits\Ruled;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Traits\Craftable;
use App\Traits\Navigatable;
use App\Traits\Owned;
use App\Traits\Presentable;
use App\Traits\Requirable;
use App\Traits\Salvageable;
use App\Traits\Taggable;
use App\Contracts\ItemContract;

class Durable extends FinalProduct implements ItemContract, NavigatableContract {
	use Craftable;
	use Navigatable;
	use Owned;
	use Presentable;
	use Requirable;
	use Ruled;
	use Salvageable;
	use Taggable;
	protected $consumable = false;
	public function __construct($attributes=[]){
		parent::__construct($attributes);
		$this->itemType()->associate(ItemType::where('title','=','Durable')->first());
	}
	//relations
	public function craftingOccurrence() {
		return $this->belongsTo ( 'App\CraftingOccurrence' );
	}
	public function ownable() {
		return $this->belongsTo ( 'App\Ownable' );
	}
	public function scope($query){
		return $query->where('item_type_id',ItemType::where('title','Durable')->first()->id);
	}
}
