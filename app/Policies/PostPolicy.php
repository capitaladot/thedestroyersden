<?php

namespace App\Policies;

use App\User;
use App\Thread;
use App\Post;
use Illuminate\Support\Facades\Gate;

class PostPolicy {
	/**
	 * Permission: Delete posts in thread.
	 *
	 * @param  object  $user
	 * @param  Thread  $thread
	 * @return bool
	 */
	public function deletePosts($user, Thread $thread)
	{
		if($user->isAdmin())
			return true;
		return false;
	}

	/**
	 * Permission: Rename thread.
	 *
	 * @param  object  $user
	 * @param  Thread  $thread
	 * @return bool
	 */
	public function rename($user, Thread $thread)
	{
		return $user->isAdmin() || $user->id === $thread->author_id;
	}

	/**
	 * Permission: Reply to thread.
	 *
	 * @param  object  $user
	 * @param  Thread  $thread
	 * @return bool
	 */
	public function reply($user, Thread $thread)
	{
		return !$thread->locked;
	}

	/**
	 * Permission: Delete thread.
	 *
	 * @param  object  $user
	 * @param  Post $post
	 * @return bool
	 */
	public function delete($user, Post $post)
	{
		$thread = $post->thread;
		$category = $post->thread->category;
		return Gate::allows('deletePosts', $thread) || $user->id === $thread->author_id;
	}
}

