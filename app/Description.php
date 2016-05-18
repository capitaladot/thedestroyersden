<?php 

namespace App;
use App\BaseModel;
use MartinBean\MenuBuilder\Contracts\NavigatableContract;
//traits
use App\Traits\Fillable;
use App\Traits\Navigatable;

class Description extends BaseModel implements NavigatableContract{
	public $table = 'descriptions';
	use Fillable;
	use Navigatable;
}
