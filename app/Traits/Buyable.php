<?php

namespace App\Traits;

trait Buyable {
	/**
	 * Return either a pegged price or the recursive summation of the tools and
	 * components used in crafting the item.
	 *
	 * @param string $transactionType
	 *        	'buy'|'sell'
	 * @return number
	 */
	public function price($transactionType = 'buy') {
		$craft = $this->crafts()
			->first();
		if(! empty ( $this->getAttribute('price') ))
			$price = $this->getAttribute('price');
		elseif(is_null($craft))
			return '-';
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
			$price = $requirementsCost + count ( $craft->craftingRequirements->filter(function($eachRequirement){
				return !empty($eachRequirement->tools());
			}));
		}
		return $price;
	}
	public function buyable() {
		return $this->morphsTo ();
	}
}
