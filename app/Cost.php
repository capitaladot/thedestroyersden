<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\BaseModel; use McCool\LaravelAutoPresenter\HasPresenter;
use App\Traits\Fillable;
use App\Traits\CharacterClassable;
use App\Traits\Skillable;
use App\Traits\Homelandable;
use App\Traits\Raceable;
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
