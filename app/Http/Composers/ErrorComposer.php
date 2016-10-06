<?php
/**
 * Created by PhpStorm.
 * User: austi_000
 * Date: 7/9/2016
 * Time: 8:04 AM
 */

namespace App\Http\Composers;


class ErrorComposer
{
	public function __construct()
	{

	}
	public function compose(){
		view()->share('master', 'vendor.smorken.errors.errors.master');
	}
}
