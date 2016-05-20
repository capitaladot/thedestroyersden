<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent as Eloquent;
use Illuminate\Support\Facades\Auth;
use App\BaseModel;
use App\User;
use Log;
use Bican\Roles\Models\Role;


class BaseController extends Controller {
	protected $baseUrl;
	protected $controllerName;
	protected $modelName;
	protected $user;
	public function __construct() {
		$this->controllerName = class_basename ( $this );
		$this->modelName = class_basename ( $this->repository->model () );
		$this->baseUrl = strtolower($this->modelName);
		if(Auth::guest()){
			$this->user = User::findOrFail(1);
		}
		else{
			$this->user = Auth::user();
		}
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Route $route) {
		if($this->user->can('list.'.str_slug(str_plural($this->baseUrl)))) {
			$all = $this->repository->all();
			return view((view()->exists($this->baseUrl . '/index')
				? ($this->baseUrl . '/index')
				: 'index'
			), [
				'baseUrl' => $this->baseUrl,
				'modelName' => strtolower(class_basename($this->repository->model())),
				'models' => $all ? $all : [],
				'route' => $route
			]);
		}
		abort(403, 'Unauthorized action.');
	}

	/**
	 * @param Route $route
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function trim(Route $route) {
		if($this->user->can('edit.'.str_slug(str_plural($this->baseUrl)))) {
			$all = $this->repository->all();
			foreach ($all as $eachItem) {
				$eachItem->title = trim($eachItem->title);
				$eachItem->save();
			}
			return view((view()->exists($this->baseUrl . '/trim')
				? ($this->baseUrl . '/trim')
				: 'trim'
			), [
				'modelName' => strtolower(class_basename($this->repository->model())),
				'models' => $all ? $all : [],
				'route' => $route
			]);
		}
		abort(403, 'Unauthorized action.');
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Route $route) {
		if($this->user->can('create.'.str_slug(str_plural($this->baseUrl)))) {
			$create = $this->repository->makeModel();
			if (FALSE !== array_search("App\Traits\Fillable", $create->traits))
				$create = $create->getProcessedFillables();
			$create = $create->provideRelatables();
			return view((view()->exists($this->baseUrl . '/create')
				? ($this->baseUrl . '/create')
				: 'trim'
			), [
				'model' => $create,
				'route' => $route,
				'modelName' => class_basename($this->repository->model()),
				'controllerName' => $this->controllerName,
				'fillables' => $create->processedFillables,
				'relationControls' => $create->relationControls
			]);
		}
		abort(403, 'Unauthorized action.');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		if($this->user->can('store.'.str_slug(str_plural($this->baseUrl)))) {
			$validate = $this->repository->makeModel();
			$validate->validate($request->all());
			if ($validate->validator->fails()) {
				return redirect()->back()->withInput()->withErrors($validate->validator);
			} else {
				if ($validate->validator->passes() && $validate->save()) {
					Log::info("Controller: Saved " . class_basename(get_class($this->repository->model) . " with ID " . $validate->id));
					$url = (false !== array_search('App\Traits\Navigatable', $this->repository->model->traits))
						? $this->repository->model->getUrl()
						: $this->baseUrl . '/' . $validate->id;
					return redirect($url);
				} else {
					dd($validate);
				}
			}
		}
		abort(403, 'Unauthorized action.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function show($idOrSlug, Route $route) {
		if($this->user->can('read.'.str_slug(str_plural($this->baseUrl)))) {
			$show = $this->repository->find($idOrSlug);
			if (!$show)
				return response('Not found.', 404);
			$show = $show->provideRelatables();
			$show = $show->getProcessedFillables();
			return view((view()->exists($this->baseUrl . '/show')
				? ($this->baseUrl . '/show')
				: 'show'
			), [
				'route' => $route,
				'modelName' => $this->modelName,
				'baseUrl' => $this->baseUrl,
				'model' => $show,
				'edit' => $show->getUrl() . '/edit',
				'table' => $show->getTable(),
				'hidden' => $show->getHidden(),
				'fillables' => $show->processedFillables,
				'relationControls' => $show->relationControls,
				'relationMethods' => $show->relationMethods,
				'title' => isset ($show->traits ['App\Traits\Navigatable']) ? $show->getTitle() : ''
			]);
		}
		abort(403, 'Unauthorized action.');
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function edit($idOrSlug, Route $route) {
		if($this->user->can('edit.'.str_slug(str_plural($this->baseUrl)))) {
			$edit = $this->repository->find($idOrSlug);
			$edit = $edit->getProcessedFillables();
			$edit = $edit->provideRelatables();
			return view((view()->exists($this->baseUrl . '/edit')
				? ($this->baseUrl . '/edit')
				: 'edit'
			), [
				'baseUrl' => $this->baseUrl,
				'route' => $route,
				'modelName' => class_basename($this->repository->model()),
				'controllerName' => $this->controllerName,
				'model' => $edit,
				'fillables' => $edit->processedFillables,
				'relationControls' => $edit->relationControls,
				'table' => $edit->getTable()
			]);
		}
		abort(403, 'Unauthorized action.');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function update($idOrSlug, Request $request) {
		if($this->user->can('edit.'.str_slug(str_plural($this->baseUrl)))) {
			$update = $this->repository->find($idOrSlug);
			$update->validate($request->all());
			if ($update->validator->fails()) {
				return redirect()->back()->withInput()->withErrors($update->validator);
			} else {
				if ($update->validator->passes()) {
					$update->push();
				}
				$url = (FALSE !== array_search("App\Traits\Navigatable", $update->traits)
					? $this->repository->model->getUrl()
					: $this->baseUrl . '/' . $update->id);
				return redirect($url);
			}
		}
		abort(403, 'Unauthorized action.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function destroy($idOrSlug) {
		if($this->user->can('delete.'.str_slug(str_plural($this->baseUrl)))) {
			$delete = $this->repository->find($idOrSlug);
			$delete->delete();
			return redirect(strtolower($this->baseUrl));
		}
		abort(403, 'Unauthorized action.');
	}
}

?>
