<?php

namespace App\Policies;

use Illuminate\Support\Facades\Gate;
use App\Thread;
use App\User;


class ThreadPolicy{
	/**
	 * Permission: Delete posts in thread.
	 *
	 * @param  object  $user
	 * @param  Thread  $thread
	 * @return bool
	 */
	public function deletePosts($user, Thread $thread)
	{
		if($user->isAdmin() || $thread->author_id == $user->id)
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
		if($user->isAdmin() || $thread->author_id == $user->id)
			return true;
		return false;
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
	 * @param  Thread  $thread
	 * @return bool
	 */
	public function delete($user, Thread $thread)
	{
		return $user->isAdmin() || Gate::allows('deleteThreads', $thread->category) || $user->id === $thread->author_id;
	}
}

