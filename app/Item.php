<?php

namespace App;

use App\BaseModel;

trait Item {
	/**
	 * which player character did the creating?
	 */
	public function owner() {
		return $this->morphTo ( 'App\Ownership', 'ownable' );
	}
	/**
	 * Return either a pegged price or the recursive summation of the tools and
	 * components used in crafting the item.
	 *
	 * @param string $transactionType
	 *        	'buy'|'sell'
	 * @return number
	 */
	public function calculatePrice($transactionType) {
		return ! empty ( $this->price ) ? $this->price : ($this->craftingComponents->sum ( function () use($transactionType) {
			return $this->calculatePrice ( $transactionType );
		} ) + count ( $this->craftingTechnique->tools () ));
	}
	public function buyable(){
		return $this->morphsTo();
	}
	public function saleable(){
		return $this->morphsTo();
	}
}