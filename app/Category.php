<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Riari\Forum\Models\Category as C;
use \App\Thread as Thread;
use Illuminate\Support\Facades\Gate;

class Category extends C{
	use SoftDeletes;
	/**
	 * Relationship: Threads.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function threads()
	{
		$withTrashed = Gate::allows('viewTrashedThreads');
		$query = $this->hasMany(Thread::class);
		return $withTrashed ? $query->withTrashed() : $query;
	}
}
