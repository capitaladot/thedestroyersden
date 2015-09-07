<?php

namespace App;

use App\BaseModel; 
use McCool\LaravelAutoPresenter\HasPresenter;
use App\Traits\Fillable;
use App\Traits\Presentable;
use App\Discount;

class Order extends BaseModel implements HasPresenter{
	use Fillable;
	use Presentable;
	const EVENT_PRICE = 30;
	public $fillable = ['approved','executed','failed','final_total','processor','reference_id','user_id'];
	public function tickets(){
		return $this->hasMany('App\Ticket');
	}
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function getTotal(){
		return count($this->tickets) * self::EVENT_PRICE;
	}
	public function discount(){
		$this->belongsTo('App\Discount');
	}
	public function execute(){
		$this->executed = true;
		if(count($this->discount()))
			$this->final_total = ($this->getTotal() - $this->discount()->amount) * $this->discount()->percentage;
		else
			$this->final_total = $this->getTotal();
	}
}