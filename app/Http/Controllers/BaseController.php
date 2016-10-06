<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent as Eloquent;
use Auth;
use App\BaseModel;
use App\User;
use Log;
use Bican\Roles\Models\Role;


class BaseController extends Controller {
	protected $baseUrl;
	protected $controllerName;
	protected $isBaseModel;
	protected $modelName;
	protected $repository;
	protected $user;
	public function __construct() {
		$this->controllerName = class_basename ( $this );
		$this->modelName = class_basename ( $this->repository->model () );
		$this->baseUrl = strtolower($this->modelName);
		if(Auth::check()){
			$this->user = Auth::user();
		}
		else{
			$this->user = User::findOrFail(1);
		}
		$this->isBaseModel = is_subclass_of($this->repository->model,"App\BaseModel");
		$this->guestRole = Role::where('name','Guest')->firstOrFail();
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Route $route) {
		if($this->user->can('list.'.str_slug($this->baseUrl))) {
			$all = $this->repository->all();
			return view(\resolveView($this->repository->model,'index'), [
				'model'=>$this->repository->model,
				'baseUrl' => $this->baseUrl,
				'modelName' => strtolower(class_basename($this->repository->model())),
				'models' => $all ? $all : [],
			]);
		}
		elseif($this->user->is($this->guestRole->id))
			return redirect('auth/login');
		else
			abort(403, 'Unauthorized action.list.'.str_slug($this->baseUrl));
	}

	/**
	 * @param Route $route
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function trim(Route $route) {
		if($this->user->can('edit.'.str_slug($this->baseUrl))) {
			$all = $this->repository->all();
			foreach ($all as $eachItem) {
				$eachItem->title = trim($eachItem->title);
				$eachItem->save();
			}
			return view(\resolveView($this->repository->model,'trim'), [
				'modelName' => strtolower(class_basename($this->repository->model())),
				'models' => $all ? $all : [],
				'route' => $route
			]);
		}
		if($this->user->is($this->guestRole))
			return redirect('auth/login');
		else
			abort(403, 'Unauthorized action.edit.'.str_slug($this->baseUrl));
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Route $route) {
		if($this->user->can('create.'.str_slug($this->baseUrl))) {
			$create = $this->repository->makeModel();
			if ($create->hasTrait("App\Traits\Fillable"))
				$create = $create->getProcessedFillables();
			$create = $create->provideRelatables();
			return view(\resolveView($this->repository->model,'create'), [
				'model' => $create,
				'route' => $route,
				'modelName' => class_basename($this->repository->model()),
				'controllerName' => $this->controllerName,
				'fillables' => $create->processedFillables,
				'relationControls' => $create->relationControls
			]);
		}
		if($this->user->is($this->guestRole))
			return redirect('auth/login');
		else
			abort(403, 'Unauthorized action.create.'.str_slug($this->baseUrl));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		if($this->user->can('create.'.str_slug($this->baseUrl))) {
			$validate = $this->repository->makeModel();
			$validate->validate($request->all());
			if ($validate->validator->fails()) {
				return redirect()->back()->withInput()->withErrors($validate->validator);
			} else {
				if ($validate->validator->passes() && $validate->saveOrFail() && $validate->push() && $validate->attachRequiredRelations($request->all())) {
					Log::info("Controller: Saved " . class_basename(get_class($this->repository->model) . " with ID " . $validate->id));
					$url = ($validate->hasTrait('App\Traits\Navigatable'))
						? $this->repository->model->getUrl()
						: $this->baseUrl . '/' . $validate->id;
					return redirect($url);
				} else {
					\ddd($validate);
				}
			}
		}
		elseif($this->user->is($this->guestRole->id))
			return redirect('auth/login');
		else
			abort(403, 'Unauthorized action.create.'.str_slug($this->baseUrl));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function show($idOrSlug, Route $route) {
		if($this->user->can('read.'.str_slug($this->baseUrl))) {
			$show = $this->repository->find($idOrSlug);
			if (!$show){
				Log::error($idOrSlug.' not found.');
				return response('Not found.', 404);
			}
			$show = $show->provideRelatables();
			$show = $show->getProcessedFillables();
			return view(\resolveView($this->repository->model,'show'), [
				'depth' => 0,
				'modelName' => $this->modelName,
				'modelSpecific'=>[],
				'baseUrl' => $this->baseUrl,
				'model' => $show,
				'edit' => $show->getUrl() . '/edit',
				'table' => $show->getTable(),
				'hidden' => $show->getHidden(),
				'fillables' => $show->processedFillables,
				'relationControls' => $show->relationControls,
				'relationMethods' => $show->relationMethods,
				'title' => $show->hasTrait('App\Traits\Navigatable') ? $show->getTitle() : $this->modelName.' #'.$show->id
			]);
		}
		if($this->user->is($this->guestRole))
			return redirect('auth/login');
		else
			abort(403, 'Unauthorized action.read.'.str_slug($this->baseUrl));
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function edit($idOrSlug, Route $route) {
		if($this->user->can('edit.'.str_slug($this->baseUrl))) {
			$edit = $this->repository->find($idOrSlug);
			$edit = $edit->getProcessedFillables();
			$edit = $edit->provideRelatables();
			return view(\resolveView($this->repository->model,'edit'), [
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
		if($this->user->is($this->guestRole))
			return redirect('auth/login');
		else
			abort(403, 'Unauthorized action.edit.'.str_slug($this->baseUrl));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function update($idOrSlug, Request $request) {
		if($this->user->can('edit.'.str_slug($this->baseUrl))) {
			$update = $this->repository->find($idOrSlug);
			$update->validate($request->all());
			if ($update->validator->fails()) {
				return redirect()->back()->withInput()->withErrors($update->validator);
			} else {
				if ($update->validator->passes() && $update->attachRequiredRelations($request->all())) {
					$update->push();
				}
				$url = ($update->hasTrait("App\Traits\Navigatable")
					? $this->repository->model->getUrl()
					: $this->baseUrl . '/' . $update->id);
				return redirect($url);
			}
		}
		if($this->user->is($this->guestRole))
			return redirect('auth/login');
		else
			abort(403, 'Unauthorized action.edit.'.str_slug($this->baseUrl));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function destroy($idOrSlug) {
		if($this->user->can('delete.'.str_slug($this->baseUrl))) {
			$delete = $this->repository->find($idOrSlug);
			$delete->delete();
			return redirect(strtolower($this->baseUrl));
		}
		if($this->user->is($this->guestRole))
			return redirect('auth/login');
		else
			abort(403, 'Unauthorized action.delete.'.str_slug($this->baseUrl));
	}
}

?>
