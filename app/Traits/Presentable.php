<?php

namespace App\Traits;

trait Presentable {
	public function getPresenterClass() {
		return PostPresenter::class;
	}
}