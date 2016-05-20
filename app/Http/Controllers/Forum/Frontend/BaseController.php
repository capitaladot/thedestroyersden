<?php
/**
 * Created by PhpStorm.
 * User: austi_000
 * Date: 5/19/2016
 * Time: 4:11 PM
 */

namespace App\Http\Controllers\Forum\Frontend;
use Riari\Forum\Frontend\Http\Controllers\BaseController as BC;

class BaseController extends BC
{
	/**
	 * Return a prepared API dispatcher instance.
	 *
	 * @param  string  $route
	 * @param  array  $parameters
	 * @return Dispatcher
	 */
	protected function api($route, $parameters = [])
	{
		return $this->dispatcher->route("forum.api.{$route}", $parameters);
	}
}
