<?php

namespace App\Presenters;

use MartinBean\MenuBuilder\Contracts\PresenterContract;
use App\MainMenu;
use App\MainMenuItem;

class FormattedUnorderedListPresenter implements PresenterContract {
	
	/**
	 * The menu instance.
	 *
	 * @var Menu
	 */
	protected $menu;
	protected $ul_class;
	protected $li_class;
	protected $a_class;
	
	/**
	 * Instantiate a new UnorderedListPresenter instance.
	 *
	 * @param Menu $menu        	
	 */
	public function __construct(MainMenu $menu, $ul_class = '', $li_class = '', $a_class = '') {
		$this->ul_class = $ul_class;
		$this->li_class = $li_class;
		$this->menu = $menu;
	}
	
	/**
	 * @ERROR!!!
	 */
	public function render() {
		$this->menu->load ( 'items', 'items.navigatable' );
		
		if ($this->hasItems ()) {
			return sprintf ( '<ul class="%s">%s</ul>', $this->ul_class, $this->getItems () );
		}
		
		return '';
	}
	
	/**
	 * @ERROR!!!
	 */
	public function hasItems() {
		return ! $this->menu->items->isEmpty ();
	}
	
	/**
	 * @{inheritdoc}
	 */
	public function getItems() {
		$items = '';
		
		foreach ( $this->menu->items as $item ) {
			$items .= $this->getItemWrapper ( $item );
		}
		
		return $items;
	}
	
	/**
	 * Get HTML wrapper for a menu item.
	 *
	 * @param MenuItem $item        	
	 * @return string
	 */
	public function getItemWrapper(MainMenuItem $item) {
		return sprintf ( '<li class="%s"><a class="%s" href="%s">%s</a></li>', $this->li_class, $this->a_class, $item->getUrl (), $item->getTitle () );
	}
}
