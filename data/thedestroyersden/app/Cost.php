<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\BaseModel;
use App\Fillable;
use App\CharacterClassable;
use App\Skillable;
use App\Homelandable;
use App\Raceable;
/**
 *
 *
 */
class Cost extends BaseModel {
	use Fillable;
	use CharacterClassable;
	use Skillable;
	use Raceable;
	public $fillable = ['value'];
	public $relationMethods = ['characterClass','homeland','race','skill'];
}
