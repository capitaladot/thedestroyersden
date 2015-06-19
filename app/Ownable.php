<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\Navigatable; use App\Traits\Presentable;
use App\BaseModel; use McCool\LaravelAutoPresenter\HasPresenter;

class Ownable extends BaseModel implements HasPresenter, NavigatableContract {
	use Navigatable; use Presentable;
	public function playerCharacter() {
		return $this->morphsByOne ( 'App\PlayerCharacter', 'ownable' );
	}
	public function user() {
		return $this->morphsByOne ( 'App\User', 'ownable' );
	}
}
