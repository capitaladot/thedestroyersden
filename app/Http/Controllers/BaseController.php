<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent as Eloquent;
use App;
use Barryvdh\Debugbar\Facade as Debugbar;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk as LaravelFacebookSdk;
use App\Repositories\BaseRepository;

class BaseController extends Controller {
	protected $controllerName;
	public function __construct() {
		$this->controllerName = class_basename ( $this );
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Route $route) {
		$all = $this->repository->all ();
		Debugbar::info ( $all );
		return view ( 'index', [ 
				'modelName' => strtolower ( class_basename ( $this->repository->model () ) ),
				'models' => $all ? $all : [ ],
				'route' => $route 
		] );
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Route $route) {
		$create = $this->repository->makeModel ();
		$create->getProcessedFillables ();
		$create->provideRelatables ();
		return view ( 'create', [ 
				'model' => $create,
				'route' => $route,
				'modelName' => class_basename ( $this->repository->model () ),
				'controllerName' => $this->controllerName,
				'fillables' => $create->processedFillables,
				'relationControls' => $create->relationControls 
		] );
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		$validate = $this->repository->makeModel ();
		$validate->getProcessedFillables ();
		$validate->provideRelatables ();
		$validate->validate ( $request );
		if ($validate->validator->fails ()) {
			return redirect ()->back ()->withInput ()->withErrors ( $validate->validator );
		} else {
			if ($validate->validator->passes () && $validate->save ()) {
				$url = ($this->repository->model->traits ['navigatable'] ? $this->repository->model->getUrl () : strtolower ( class_basename ( get_class ( $this->repository->model ) ) ) . '/' . $validate->id);
				return redirect ( $url );
			} else {
				dd ( $validate );
			}
		}
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function show($idOrSlug, Route $route) {
		$show = $this->repository->find ( $idOrSlug );
		$show->provideRelatables ();
		$show->getProcessedFillables ();
		return view ( 'show', [ 
				'route' => $route,
				'modelName' => class_basename ( $this->repository->model () ),
				'model' => $show,
				'edit' => $show->getUrl () . '/edit',
				'table' => $show->getTable (),
				'hidden' => $show->getHidden (),
				'fillables' => $show->processedFillables,
				'relationControls' => $show->relationControls,
				'relationMethods' => $show->relationMethods,
				'title' => isset ( $show->traits ['Navigatable'] ) ? $show->getTitle () : '' 
		] );
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function edit($idOrSlug, Route $route) {
		$edit = $this->repository->find ( $idOrSlug );
		$edit->getProcessedFillables ();
		$edit->provideRelatables ();
		return view ( 'edit', array (
				'route' => $route,
				'modelName' => class_basename ( $this->repository->model () ),
				'controllerName' => $this->controllerName,
				'model' => $edit,
				'fillables' => $edit->processedFillables,
				'relationControls' => $edit->relationControls 
		) );
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function update($idOrSlug, Request $request) {
		$update = $this->repository->find ( $idOrSlug );
		$update->getProcessedFillables ();
		$update->provideRelatables ();
		$update->validate ( $request );
		if ($update->validator->fails ()) {
			return redirect ()->back ()->withInput ()->withErrors ( $update->validator );
		} else {
			if ($update->validator->passes ()) {
				$update->push ();
			}
			return redirect ( strtolower ( $this->repository->model () ) . '/' . $update->id );
		}
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function destroy($idOrSlug) {
		$delete = $this->repository->find ( $idOrSlug );
		$delete->destroy ();
		return redirect ( strtolower ( $this->repository->model () ) );
	}
}

?>