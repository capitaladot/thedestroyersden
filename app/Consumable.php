<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Consumption;
use App\Item;
use App\PlayerCharacter;
use App\Traits\Craftable;
use App\Traits\Navigatable; 
use App\Traits\Presentable;
use App\Traits\Requirable;
use App\Traits\Salvageable;
use App\Traits\Taggable;
use App\Traits\ItemTypeable;

use App\ItemType;

class Consumable extends Item implements NavigatableContract {
	use Craftable;
	use ItemTypeable;
	use Navigatable; 
	use Presentable;
	use Requirable;
	use Salvageable;
	use Taggable;
	protected $table = 'items';
	public $fillable = ['*'];
	protected $consumable = true;
	public function __construct($attributes=[]){
		parent::__construct($attributes);
		$this->itemType = ItemType::where('title','Consumable')->first();
	}
	public function consume(PlayerCharacter $consumer) {
		if (count ( $this->consumption ))
			return false;
		$consumption = new Consumption ();
		$consumption->consumer ( $consumer );
		$consumption->consumble ( $this )->save ();
		return true;
	}
	public function scope($query){
		return $query->where('item_type_id',ItemType::where('title','Consumable')->first()->id);
	}
	//relations
	public function consumption() {
		return $this->belongsTo ( 'App\Consumption' );
	}
	public function craftingOccurrence() {
		return $this->belongsTo ( 'App\CraftingOccurrence' );
	}
	public function ownable() {
		return $this->belongsTo ( 'App\Ownable' );
	}
}