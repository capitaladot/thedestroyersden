<?php

namespace App;

use App\BaseModel; use McCool\LaravelAutoPresenter\HasPresenter;
use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\Craftable;
use App\Traits\Item;
use App\Traits\Navigatable; use App\Traits\Presentable;
use App\Traits\Requireable;
use App\Traits\Salvageable;
use App\Traits\Buyable;

class Tool extends FinalProduct implements NavigatableContract {
	use Buyable;
	use Craftable;
	use Salvageable;
	use Requireable;
	use Navigatable; use Presentable;
	public $loss_factor = 2;
	public $used_by = '';
	protected $fillable = [ 
			'used_by' 
	];
}