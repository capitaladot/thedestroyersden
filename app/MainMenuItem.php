<?php

namespace App;

use App\MainMenu;
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
	public function getUrl() {
		if (count($this->navigatable)){
			try {
				return $this->navigatable->getUrl ();
			} catch ( \ErrorException $e ) {
				Log::critical ( 'MenuItem exception', [
					$e
				] );
			}
		}
	}
}
