<?php

namespace App\Traits;

trait Buyable {
	public function calculatePrice($transactionType) {
		return ! empty ( $this->price ) ? $this->price : ($this->craftingComponents->sum ( function () use($transactionType) {
			return $this->calculatePrice ( $transactionType );
		} ) + count ( $this->craftingTechnique->tools () ));
	}
	public function buyable() {
		return $this->morphsTo ();
	}
}
