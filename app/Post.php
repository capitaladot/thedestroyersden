<?php

namespace App;

use Conner\Likeable\Likeable;
use Riari\Forum\Models\Post as ForumPost;
use App\Like;
use Sleimanx2\Plastic\Searchable;

class Post extends ForumPost
{
	use Likeable;
	public $searchable = ['content'];
	/**
	 * Collection of the likes on this record
	 */
	public function likes()
	{
		return $this->morphMany(Like::class, 'likeable');
	}
	public function thread(){
		return $this->belongsTo('App\Thread');
	}
}

