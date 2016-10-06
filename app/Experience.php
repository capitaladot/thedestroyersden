<?php

namespace App;

use App\Contracts\FillableContract;
use App\Contracts\RelatableContract;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Traits\Fillable;
use App\Traits\Navigatable;
use App\Traits\Presentable;
use App\Traits\Relatable;
use McCool\LaravelAutoPresenter\HasPresenter;

class Experience extends BaseModel implements FillableContract, HasPresenter, NavigatableContract, RelatableContract {
	use Fillable;
	use Navigatable;
	use Presentable;
	use Relatable;
	public function playerCharacter() {
		return $this->hasOne ( 'App\PlayerCharacter' );
	}
	public function arc() {
		return $this->hasOne ( 'App\Arc' );
	}
	public function awarder() {
		return $this->hasOne ( 'App\User', 'awarder_id' );
	}
}
