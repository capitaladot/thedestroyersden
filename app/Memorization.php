<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\BaseModel; use McCool\LaravelAutoPresenter\HasPresenter;
use App\Traits\Navigatable; use App\Traits\Presentable;

class Memorization extends BaseModel implements HasPresenter, NavigatableContract {
	use Navigatable; use Presentable;
	protected $table = 'memorizations';
	public function expenditure() {
		return $this->belongsto ( 'App\Expenditure' );
	}
}