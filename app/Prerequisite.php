<?php
namespace App;
use App\BaseModel; use McCool\LaravelAutoPresenter\HasPresenter;
use App\Traits\Navigatable; use App\Traits\Presentable;
use App\Traits\Skillable;
class Prerequisite extends BaseModel{
	use Navigatable; use Presentable;
	use Skillable;
}