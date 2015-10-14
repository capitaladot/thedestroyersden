<?php
namespace App\Traits;

use App\Arc;

trait Arcable{
	/**
	 * each Model with this trait will be associated with a time period.
	 */
	public function arc() {
		return $this->belongsTo ( 'App\Arc' );
	}
}