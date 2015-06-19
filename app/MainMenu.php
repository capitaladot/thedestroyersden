<?php

namespace App;

use MartinBean\MenuBuilder\Menu;
use MartinBean\MenuBuilder\MenuItem;

class MainMenu extends Menu {
	protected $table = 'menus';
	public function properName() {
		return ucwords ( str_replace ( '_', ' ', snake_case ( $this->name ) ) );
	}
	public function items() {
		return $this->hasMany ( 'App\MainMenuItem', 'menu_id' );
	}
}