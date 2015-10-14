<?php

namespace App;

use App\BaseModel; 
use McCool\LaravelAutoPresenter\HasPresenter;
use App\Traits\Fillable;
use App\Traits\Presentable;
use App\Order;
/**
order related discounting.
*/
class Discount extends BaseModel{
	use Fillable;
	use Presentable;
	public $fillable = ['code','amount','percentage','start_date','end_date'];
	public function apply(Order $order){
		if(now() >= $start_date && now() <= $end_date){
			$order->discount->associate($this);
			return $order->save();
		}
		return false;
	}
}