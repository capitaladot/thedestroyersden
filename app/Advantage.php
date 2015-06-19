<?php

namespace App;

use App\BaseModel; use McCool\LaravelAutoPresenter\HasPresenter;
use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\CharacterClassable;
use App\Traits\Fillable;
use App\Traits\Homelandable;
use App\Traits\Navigatable; use App\Traits\Presentable;
use App\Traits\Raceable;

class Advantage extends BaseModel implements HasPresenter, NavigatableContract {
	use CharacterClassable;
	use Homelandable;
	use Navigatable; use Presentable;
	use Raceable;
}