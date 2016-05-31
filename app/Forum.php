<?php
/**
 * Created by PhpStorm.
 * User: austi_000
 * Date: 5/19/2016
 * Time: 9:24 AM
 */

namespace App;

use Riari\Forum\Frontend\Support\Forum as F;
use ReflectionClass;
class Forum extends F
{
	/**
	 * Render the given content.
	 *
	 * @param  string  $content
	 * @return string
	 */
	public static function render($content)
	{
		return nl2br($content);
	}
}
