<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use App\Repositories\SkillRepository;

class SkillController extends BaseController {
	public function __construct(SkillRepository $repository) {
		$this->repository = $repository;
		parent::__construct ();
	}
	public function show($idOrSlug, Route $route) {
		$show = $this->repository->find ( $idOrSlug );
		if(!$show)
			return response('Not found.',404);
		$show->provideRelatables ();
		$show->getProcessedFillables ();
		
		return view ( 'skills/show', [ 
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
			'title' => isset ( $show->traits ['Navigatable'] ) ? $show->getTitle () : '' 
		] );
	}
}