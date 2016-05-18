<?php

namespace App\Traits;

trait Buyable {
	/**
	 * Return either a pegged price or the recursive summation of the tools and
	 * components used in crafting the item.
	 *
	 * @param string $transactionType
	 *        	'buy'|'sell'
	 * @return array of number
	 */
	public function prices($transactionType = 'buy') {
		$prices = [];
		foreach($this->getCrafts() as $craft){
			if(! empty ( $this->getAttribute('price') ))
				$prices['(Fixed Price)'] = $this->getAttribute('price');
			elseif(is_null($craft))
				$prices[$craft->title] =  '-';
			else{
				$requirementsCost = $craft
					->craftingRequirements
					->filter(function($eachRequirement){
						return $eachRequirement->requirable_type == 'App\RawResource'
							||
						$eachRequirement->requirable_type == 'App\CraftingComponent' ;
					})->sum ( function ($eachRequirement) use($transactionType) {
						return
							$eachRequirement->requirable->price ( $transactionType );
					} );
				$prices[$craft->title] = $requirementsCost + count ( $craft->craftingRequirements->filter(function($eachRequirement){
					return !empty($eachRequirement->tools());
				}));
			}
		}
		return $prices;
	}
	public function buyable() {
		return $this->morphsTo ();
	}
}
