<?php

namespace App;
use App\Contracts\FillableContract;
use App\Contracts\RelatableContract;
use App\Traits\Discountable;
use App\Traits\Relatable;
use App\Traits\RoutedById;
use Carbon\Carbon;
use App\Traits\Fillable;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;

class Ticket extends BaseModel implements NavigatableContract, RelatableContract, FillableContract{
	use Discountable;
	use Fillable;
	use Relatable;
	use RoutedById;
	const ARC_PRICE = 9;
	public $fillable = ['redeemed_at','order_id'];
	public $relationMethods = ['arc','discount','order'];
	/**
	 * @param Arc $arc
	 */
	public function redeem(Arc $arc){
		$this->arc()->associate($arc);
		$this->redeemed_at = new Carbon();
		$this->save();
	}
	//relations
	public function arc(){
		return $this->morphToMany('App\Arc','attendable');
	}
	public function order(){
		return $this->belongsTo('App\Order');
	}
	public function getTitle(){
		if(count($this->arc)) {
			$arc = $this->arc->first();
			$arc->load('event');
			return studly_case(str_singular(str_replace("_"," ",$this->table))). " #".$this->id. " to " .$arc->title . ', ' . $arc->event->title;
		}
		return studly_case(str_singular(str_replace("_"," ",$this->table))). " #".$this->id;
	}
}
