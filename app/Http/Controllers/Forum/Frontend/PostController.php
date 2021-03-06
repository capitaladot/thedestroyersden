<?php

namespace App\Http\Controllers\Forum\Frontend;

use App\Http\Controllers\Forum\Frontend\BaseController;
use Illuminate\Http\Request;
use Riari\Forum\Frontend\Events\UserViewingPost;
use Riari\Forum\Frontend\Events\UserCreatingPost;
use App\Forum;
use Illuminate\Support\Facades\Gate;

class PostController extends BaseController
{
	/**
	 * GET: Return a post view.
	 *
	 * @param  Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request)
	{
		$post = $this->api('post.fetch', $request->route('post'))->parameters(['with' => ['thread', 'thread.category', 'parent']])->get();
		ini_set('memory_limit','384M');
		\ddd($post);
		event(new UserViewingPost($post));
		return view('forum::post.show', collect(['category'=>$post->thread->category, 'thread'=>$post->thread, 'post'=>$post]));
	}

	/**
	 * GET: Return a 'create post' (thread reply) view.
	 *
	 * @param  Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request)
	{
		$thread = $this->api('thread.fetch', $request->route('thread'))->parameters(['with' => ['posts']])->get();

		$this->authorize('reply', $thread);

		event(new UserCreatingPost($thread));

		$post = null;
		if ($request->has('post')) {
			$post = $thread->posts->find($request->input('post'));
		}

		return view('forum::post.create', collect(['thread'=>$thread, 'post'=>$post]));
	}

	/**
	 * POST: Create a post.
	 *
	 * @param  Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request)
	{
		$thread = $this->api('thread.fetch', $request->route('thread'))->parameters(['with' => ['posts']])->get();

		$this->authorize('reply', $thread);

		$post = null;
		if ($request->has('post')) {
			$post = $thread->posts->find($request->input('post'));
		}
		$post = $this->api('post.store')->parameters([
			'thread_id' => $thread->id,
			'author_id' => auth()->user()->id,
			'post_id'   => is_null($post) ? 0 : $post->id,
			'content'   => $request->input('content')
		])->post();
		$post->thread->touch();

		Forum::alert('success', 'general.reply_added');

		return redirect(Forum::route('thread.show', $post));
	}

	/**
	 * GET: Return an 'edit post' view.
	 *
	 * @param  Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Request $request)
	{
		$post = $this->api('post.fetch', $request->route('post'))->get();

		event(new UserEditingPost($post));

		if ($post->trashed()) {
			return abort(404);
		}

		$this->authorize($post);

		$thread = $post->thread;
		$category = $post->thread->category;

		return view('forum::post.edit', compact('category', 'thread', 'post'));
	}

	/**
	 * PATCH: Update an existing post.
	 *
	 * @param  Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Request $request)
	{
		$post = $this->api('post.fetch', $request->route('post'))->get();

		$this->authorize('edit', $post);

		$post = $this->api('post.update', $request->route('post'))->parameters($request->only('content'))->patch();

		Forum::alert('success', 'posts.updated');

		return redirect(Forum::route('thread.show', $post));
	}

	/**
	 * DELETE: Delete a post.
	 *
	 * @param  Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy(Request $request)
	{
		$permanent = !config('forum.preferences.soft_deletes');

		$parameters = $request->all();

		if ($permanent) {
			$parameters['force'] = 1;
		}

		$post = $this->api('post.delete', $request->route('post'))->parameters($parameters)->delete();

		Forum::alert('success', 'posts.deleted', 1);

		return redirect(Forum::route('thread.show', $post->thread));
	}

	/**
	 * DELETE: Delete posts in bulk.
	 *
	 * @param  Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function bulkDestroy(Request $request)
	{
		$this->validate($request, ['action' => 'in:delete,permadelete']);

		$parameters = $request->all();

		if (!config('forum.preferences.soft_deletes') || ($request->input('action') == 'permadelete')) {
			$parameters['force'] = 1;
		}

		$posts = $this->api('bulk.post.delete')->parameters($parameters)->delete();
		return $this->bulkActionResponse($posts, 'posts.deleted');
	}

	/**
	 * PATCH: Update posts in bulk.
	 *
	 * @param  Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function bulkUpdate(Request $request)
	{
		$this->validate($request, ['action' => 'in:restore']);

		$action = $request->input('action');

		$threads = $this->api("bulk.post.{$action}")->parameters($request->all())->patch();

		return $this->bulkActionResponse($threads, 'posts.updated');
	}
}

