<?php

namespace App;

use Riari\Forum\Models\Category as C;
use App\Thread;
use Illuminate\Support\Facades\Gate;

class Category extends C{
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
