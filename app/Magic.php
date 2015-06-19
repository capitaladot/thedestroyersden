<?php

namespace App;

use App\BaseModel; use McCool\LaravelAutoPresenter\HasPresenter;
use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\Navigateable;

class Magic extends BaseModel implements HasPresenter, NavigatableContract {
	use Navigatable; use Presentable;
}