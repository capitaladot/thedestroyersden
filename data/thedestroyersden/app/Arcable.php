<?php
namespace App;

trait Arcable{
	/**
	 * each Model with this trait will be associated with a time period.
	 */
	public $arc_id;
	public function arc() {
		return $this->belongsTo ( 'App\Arc' );
	}
}