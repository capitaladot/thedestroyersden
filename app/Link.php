<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Traits\Navigatable;
use App\Traits\Presentable;
use App\BaseModel;
use McCool\LaravelAutoPresenter\HasPresenter;
use App\Traits\Fillable;
use App\Traits\Relatable;

class Link extends BaseModel implements HasPresenter, NavigatableContract {
	use Fillable;
	use Navigatable;
	use Presentable;
	use Relatable;
	public $fillable = ['link'];
	/* This thing has an actual external URL. */
	public function getUrl() {
		return $this->link;
	}
}
