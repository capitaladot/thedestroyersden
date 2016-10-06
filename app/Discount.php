<?php

namespace App;

use App\BaseModel;
use App\Contracts\FillableContract;
use App\Contracts\RelatableContract;
use App\Traits\Navigatable;
use App\Traits\Relatable;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use McCool\LaravelAutoPresenter\HasPresenter;
use App\Traits\Fillable;
use App\Traits\Presentable;
use App\Order;
/**
order related discounting.
*/
class Discount extends BaseModel implements FillableContract,NavigatableContract,RelatableContract{
	use Fillable;
	use Navigatable;
	use Presentable;
	use Relatable;
	public $fillable = ['code','amount','percentage','start_date','end_date'];
	public function apply(Order $order){
		if(now() >= $this->start_date && now() <= $this->end_date){
			$order->discount->associate($this);
			return $order->save();
		}
		return false;
	}
}
