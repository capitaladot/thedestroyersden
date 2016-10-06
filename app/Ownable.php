<?php

namespace App;

use App\Contracts\FillableContract;
use App\Contracts\RelatableContract;
use App\Traits\Fillable;
use App\Traits\Relatable;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Traits\Navigatable;
use App\Traits\Presentable;
use McCool\LaravelAutoPresenter\HasPresenter;

class Ownable extends BaseModel implements FillableContract, HasPresenter, NavigatableContract, RelatableContract {
	use Fillable;
	use Navigatable;
	use Presentable;
	use Relatable;
	public function playerCharacter() {
		return $this->morphsByOne ( 'App\PlayerCharacter', 'ownable' );
	}
	public function user() {
		return $this->morphsByOne ( 'App\User', 'ownable' );
	}
}
