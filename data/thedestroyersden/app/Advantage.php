<?php
namespace App;

use App\BaseModel;
use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\CharacterClassable;
use App\Fillable;
use App\Homelandable;
use App\Navigatable;
use App\Raceable;

class Advantage extends BaseModel implements NavigatableContract{
	use CharacterClassable;
	use Fillable;
	use Homelandable;
	use Navigatable;
	use Raceable;
}