<?php

namespace App;

use Riari\Forum\Models\Thread as T;
use Conner\Likeable\Likeable;
use Illuminate\Support\Facades\Gate;
use App\Like;

class Thread extends T{
	use Likeable;
	/**
	 * Relationship: Posts.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function posts()
	{
		$withTrashed = config('forum.preferences.display_trashed_posts') || Gate::allows('viewTrashedPosts');
		$query = $this->hasMany(Post::class);
		return $withTrashed ? $query->withTrashed() : $query;
	}
	/**
	 * Collection of the likes on this record
	 */
	public function likes()
	{
		return $this->morphMany(Like::class, 'likeable');
	}
}
