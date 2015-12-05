<?php

namespace App;

use MartinBean\MenuBuilder\Menu;
use MartinBean\MenuBuilder\MenuItem;

class MainMenuItem extends MenuItem {
	protected $table = 'menu_items';
	public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery()->orderBy('sort_order','ASC');
    }
	//relations
	public function menu() {
		return $this->belongsTo ( 'App\MainMenu', 'menu_id' );
	}
}