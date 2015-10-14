<?php

namespace App;

use App\BaseModel; use McCool\LaravelAutoPresenter\HasPresenter;
use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Item;
use App\Traits\Craftable;
use App\Traits\ItemTypeable;
use App\Traits\Navigatable; 
use App\Traits\Presentable;
use App\Traits\Requireable;
use App\Traits\Salvageable;
use App\Traits\Buyable;
use App\ItemType;

class Tool extends FinalProduct implements NavigatableContract {
	use Buyable;
	use Craftable;
	use ItemTypeable;
	use Salvageable;
	use Requireable;
	use Navigatable; 
	use Presentable;
	public $loss_factor = 2;
	public $used_by = '';
	protected $fillable = [ 
		'*' 
	];
	public $table = 'items';
	public function scope($query){
		return $query->where('item_type_id',ItemType::where('title','Tool')->first()->id);
	}
}