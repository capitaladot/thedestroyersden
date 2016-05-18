<?php

namespace App\Policies;

use Riari\Forum\Policies\PostPolicy as RFP;
use Riari\Forum\Models\Post;

class PostPolicy extends RFP{
	/**
	 * Permission: Edit post.
	 *
	 * @param  object  $user
	 * @param  Post  $post
	 * @return bool
	 */
	public function edit($user, Post $post)
	{
		return $user->id === $post->author_id;
	}

	/**
	 * Permission: Delete post.
	 *
	 * @param  object  $user
	 * @param  Post  $post
	 * @return bool
	 */
	public function delete($user, Post $post)
	{
		return Gate::forUser($user)->allows('deletePosts', $post->thread) || $user->id === $post->user_id;
	}
}

