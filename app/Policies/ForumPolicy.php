<?php

namespace App\Policies;

use Riari\Forum\Policies\ForumPolicy as RFP;

class ForumPolicy extends RFP{
	/**
	 * Permission: Create categories.
	 *
	 * @param  object  $user
	 * @return bool
	 */
	public function createCategories($user)
	{
		if($user->isAdmin())
			return true;
		return false;
	}

	/**
	 * Permission: Manage category.
	 *
	 * @param  object  $user
	 * @return bool
	 */
	public function manageCategories($user)
	{
		return $this->moveCategories($user) ||
		$this->renameCategories($user);
	}

	/**
	 * Permission: Move categories.
	 *
	 * @param  object  $user
	 * @return bool
	 */
	public function moveCategories($user)
	{
		if($user->isAdmin())
			return true;
		return false;
	}

	/**
	 * Permission: Rename categories.
	 *
	 * @param  object  $user
	 * @return bool
	 */
	public function renameCategories($user)
	{
		if($user->isAdmin())
			return true;
		return false;
	}

	/**
	 * Permission: Mark new/updated threads as read.
	 *
	 * @param  object  $user
	 * @return bool
	 */
	public function markNewThreadsAsRead($user)
	{
		return true;
	}

	/**
	 * Permission: View trashed threads.
	 *
	 * @param  object  $user
	 * @return bool
	 */
	public function viewTrashedThreads($user)
	{
		if($user->isAdmin())
			return true;
		return false;
	}

	/**
	 * Permission: View trashed posts.
	 *
	 * @param  object  $user
	 * @return bool
	 */
	public function viewTrashedPosts($user)
	{
		if($user->isAdmin())
			return true;
		return false;
	}
}

