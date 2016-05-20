<?php

namespace App;

use Conner\Likeable\Likeable;
use Riari\Forum\Models\Post as ForumPost;
use App\Like;

class Post extends ForumPost
{
	use Likeable;
	/**
	 * Collection of the likes on this record
	 */
	public function likes()
	{
		return $this->morphMany(Like::class, 'likeable');
	}
}

