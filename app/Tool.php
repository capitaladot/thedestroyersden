<?php

namespace App;

use App\BaseModel;
use App\Traits\Ruled;
use McCool\LaravelAutoPresenter\HasPresenter;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Item;
use App\Traits\Craftable;
use App\Traits\ItemTypeable;
use App\Traits\Navigatable; 
use App\Traits\Presentable;
use App\Traits\Requirable;
use App\Traits\Salvageable;
use App\Traits\Buyable;
use App\ItemType;

class Tool extends FinalProduct implements NavigatableContract {
	use Buyable;
	use Craftable;
	use ItemTypeable;
	use Salvageable;
	use Requirable;
	use Navigatable; 
	use Presentable;
	use Ruled;
	public $loss_factor = 2;
	public $used_by = '';
	protected $fillable = [ 
		'*' 
	];
	public $table = 'items';
	public function __construct($attributes=[]){
		parent::__construct($attributes);
		$this->itemType()->associate(ItemType::where('title','=','Tool')->first());
	}
	public function newQuery( $excludeDeleted = true){
		return parent::newQuery()->where('item_type_id',ItemType::where('title','Tool')->first()->id);
	}
}
