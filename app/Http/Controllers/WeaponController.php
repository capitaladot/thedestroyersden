<?php

namespace App\Http\Controllers;
use App\Repositories\WeaponRepository;
use Illuminate\Routing\Route;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;

class WeaponController extends BaseController {
	public function __construct(WeaponRepository $repository) {
		$this->repository = $repository;
		parent::__construct ();
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Route $route) {
		$all = $this->repository->all ();
		return view ( 'items/index', [ 
				'modelName' => strtolower ( class_basename ( $this->repository->model () ) ),
				'models' => $all ? $all : [ ],
				'route' => $route 
		] );
	}
	public function show($idOrSlug, Route $route) {
		$show = $this->repository->find ( $idOrSlug );
		if(!$show)
			return response('Not found.',404);
		$show->provideRelatables ();
		$show->getProcessedFillables ();
		
		return view ( 'items/show', [ 
			'route' => $route,
			'modelName' => $this->modelName,
			'baseUrl'=>$this->baseUrl,
			'model' => $show,
			'edit' => $show->getUrl () . '/edit',
			'table' => $show->getTable (),
			'hidden' => $show->getHidden (),
			'fillables' => $show->processedFillables,
			'relationControls' => $show->relationControls,
			'relationMethods' => $show->relationMethods,
			'title' => $show->implementsInterface(NavigatableContract::class) ? $show->getTitle () : ''
		] );
	}
}
