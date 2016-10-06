<?php
/**
 * Created by PhpStorm.
 * User: austi_000
 * Date: 5/30/2016
 * Time: 1:14 PM
 */

namespace App;
use App\Traits\Navigatable;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;

class Role extends \Bican\Roles\Models\Role implements NavigatableContract
{
	use Navigatable;
}
