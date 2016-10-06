<?php
/**
 * Created by PhpStorm.
 * User: austi_000
 * Date: 5/23/2016
 * Time: 4:41 PM
 */

namespace App\Providers;
use Illuminate\Support\ServiceProvider;

class SquareServiceProvider extends ServiceProvider
{
	public function register()
	{
		// TODO: Implement register() method.
		$this->mergeConfigFrom(config_path()."square.php","square");
	}
}
