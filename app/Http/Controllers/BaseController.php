<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Eloquent;
use App;
class BaseController extends Controller {
	public $controllerName, $modelName;
	public function __construct() {
		$this->controllerName = class_basename ( get_class($this) );
		$this->modelName = str_replace ( "Controller", "", $this->controllerName );
		$this->namespacedModelClass = 'App\\' . $this->modelName;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$all = call_user_func($this->namespacedModelClass.'::paginate');
		return view ('index',[
			'modelName' => strtolower($this->modelName),
			'models' => $all ? $all : []
		]);
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Route $route) {
		$this->model = new $this->namespacedModelClass;
		$this->model->getProcessedFillables();
		$this->model->provideRelatables();
		return view ( 'create',[
			'model'=>$this->model,
			'route' => $route,
			'modelName' => $this->modelName,
			'controllerName' => $this->controllerName,
			'fillables' => $this->model->processedFillables,
			'relatedModels' => $this->model->relatedModels
		] );
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		$validate = new $this->namespacedModelClass;
		$validate->getProcessedFillables();
		$validate->provideRelatables();
		$validate->validate($request);
		if($validate->validator->fails()){
			return redirect()
				->back()
				->withInput()
				->withErrors($validate->validator);
		}
		else{
			if($validate->validator->passes() && $validate->save()){
				return redirect(strtolower($this->modelName).'/'.$validate->id);
			}
			else{
				dd($store);
			}
		}
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function show($id,Route $route) {
		$this->model = new $this->namespacedModelClass;
		$edit = $this->model
			->findOrFail($id);
		$edit->load($this->model->relationMethods);
		$edit->getProcessedFillables();
		$edit->provideRelatables();
		return view('show',[
			'route' => $route,
			'modelName' => $this->modelName,
			'model'=>$edit,
			'fillables' => $edit->processedFillables,
			'relatedModels' => $edit->relatedModels,
			'title' => isset($edit->traits['Navigatable']) ? $edit->getTitle() : ''
		]);
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function edit($id,Route $route) {
		$this->model = new $this->namespacedModelClass;
		$edit = $this->model
			->findOrFail($id);
		$edit->load($this->model->relationMethods);
		$edit->getProcessedFillables();
		$edit->provideRelatables();
		return view ( 'edit', array (
			'route' => $route,
			'modelName' => $this->modelName,
			'controllerName' => $this->controllerName,
			'model' => $edit,
			'fillables' => $edit->processedFillables,
			'relatedModels' => $edit->relatedModels
		) );
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		$update = call_user_func_array($this->namespacedModelClass.'::findOrFail',[$id]);
		$update->getProcessedFillables();
		$update->provideRelatables();
		$update->validate($request);
		if($update->validator->fails()){
			return redirect()
				->back()
				->withInput()
				->withErrors($update->validator);
		}
		else{
			if($update->validator->passes()){
				$update->push();
			}
			return redirect(strtolower($this->modelName).'/'.$update->id);
		}
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function destroy($id) {
		$delete = call_user_func_array($this->namespacedModelClass.'::findOrFail',[$id]);
		$delete->destroy();
		return redirect(strtolower($this->modelName));
	}
}

?>