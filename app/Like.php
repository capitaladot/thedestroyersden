<?php

namespace App;

use Conner\Likeable\Like as L;

class Like extends L
{
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user(){
		return $this->belongsTo('App\User');
	}
}
