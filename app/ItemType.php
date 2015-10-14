<?php

namespace App;
use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\BaseModel; 
use McCool\LaravelAutoPresenter\HasPresenter;
use App\Traits\Navigatable; 

class ItemType extends BaseModel implements NavigatableContract{
	use Navigatable;
	protected $table = 'item_types';
}