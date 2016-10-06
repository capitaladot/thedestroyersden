<?php

namespace App;

use App\Traits\Relatable;
use App\Traits\RoutedById;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use McCool\LaravelAutoPresenter\HasPresenter;
use App\Traits\Fillable;
use App\Traits\Presentable;
use App\Discount;
use App\Ticket;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Processor;

class Order extends BaseModel implements HasPresenter, NavigatableContract{
	use Fillable;
	use RoutedById;
	use Presentable;
	use Relatable;


	public $casts = [
		'approved'=>'boolean',
		'executed'=>'boolean',
		'failed'=>'boolean',
		'final_total'=>'long'
	];
	public $fillable = ['approved','executed','failed','final_total','processor_id','reference_id','user_id'];
	public $hidden = ['approved','executed','failed','final_total','processor_id','user'];
	public $relationMethods = ['processor','user','tickets'];
	protected $table = 'orders';

	public function currentTotal(){
		if($this->executed)
			return $this->final_total;
		else
			$total =  $this->tickets->transform(function($eachTicket){
				if(isset($eachTicket->discount->percentage))
					return Ticket::ARC_PRICE * $eachTicket->discount->percentage;
				elseif(isset($eachTicket->discount->amount))
					return Ticket::ARC_PRICE - $eachTicket->discount->amount;
				return Ticket::ARC_PRICE;
			})->sum();
		if(count($this->processor)){
			$total = round($total* (1+$this->processor->percentage),2)+$this->processor->swipe;
		}
		return $total;
	}
	public function process(){
		
	}

	/**
	 * @param  $processor Processor
	 * @parem  $referenceID string
	 */
	public function execute(Processor $processor,$referenceID){
		$this->processor()->associate($processor);
		$this->final_total = $this->currentTotal();
		$this->reference_id = $referenceID;
		$this->executed = true;
		$this->save();
		Session::forget("idempotency_key");
		Auth::user()->cart = Auth::user()->createCart();
	}
	public function getTitle(){
		return "Order #".$this->id;
	}
	//relations
	public function processor(){
		return $this->belongsTo('App\Processor');
	}
	public function tickets(){
		return $this->hasMany('App\Ticket');
	}
	public function user(){
		return $this->belongsTo('App\User');
	}
	//scopes
	public function newQuery($excludeDeleted = true){
		$query = parent::newQuery();
		if($this->hasTrait('Illuminate\Database\Eloquent\SoftDeletingTrait') && $excludeDeleted === true) {
			$query->where('deleted_at', '=', 0);
		}
		$attributes = $this->getAttributes();
		if($this->hasTrait('App\Traits\Navigatable') && isset($attributes['title'])) {
			$query->orderBy($this->table . '.title', 'ASC');
		}
		return $query;
	}
}
