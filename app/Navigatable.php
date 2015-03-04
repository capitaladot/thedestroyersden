<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;

trait Navigatable {
	public function getTitle() {
		return $this->title;
	}
	public function getUrl() {
		return route ( str_singular($this->table).'.show', [
			$this->slug
		] );
	}
	public function menuItem(){
		return $this->morphMany('MartinBean\MenuBuilder\MenuItem','navigatable');
	}
	public function menu(){
		return $this->menuItem->menu;
	}
}