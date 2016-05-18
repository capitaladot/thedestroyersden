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

	 * @return \Illuminate\Database\Eloquent\Collection|string
	 */
	public function render() {
		$this->menu->load ( 'items', 'items.navigatable' );
		$interpolation = '';
		if($this->hasAppendedItems()){
			$interpolation .= $this->getAppendedItems ();
		}
		if ($this->hasItems ()) {
			$interpolation .= $this->getItems();
		}
		return sprintf('<ul role="menu" class="%s">%s</ul>',$this->ul_class,$interpolation);
	}
	
	/**
	 * @ERROR!!!
	 */
	public function hasItems() {
		return ! $this->menu->items->isEmpty ();
	}
	public function hasAppendedItems(){
		return ! $this->menu->appendedItems->isEmpty ();
	}
	/**
	 * @{inheritdoc}
	 */
	public function getItems() {
		$itemsString = '';
		$itemsArray = $this->menu->items->sortBy('navigatable.title')->values()->all();
		foreach ( $itemsArray as $item ) {
			$itemsString .= $this->getItemWrapper ( $item );
		}
		
		return $itemsString;
	}
	/**
	 * @{inheritdoc}
	 */
	public function getAppendedItems() {
		$items = '';

		foreach ( $this->menu->appendedItems as $item ) {
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
