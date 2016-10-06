<?php namespace App\Http\Composers;

use App\Forum;
use Illuminate\Contracts\View\View;

class ForumComposer {
	public function __construct(Forum $forum){
		$x = 1;
	}
	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 * @return void
	 */
	public function compose(View $view){
		$view = $view;
	}
}
