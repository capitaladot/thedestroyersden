<?php

namespace App\Http\Controllers;

use App\Repositories\RuleRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Route;
use App\User;

class RuleController extends BaseController{
	public function __construct(RuleRepository $repository) {
		$this->repository = $repository;
		parent::__construct ();

		$this->modelName = class_basename ( $this->repository->model () );
		$this->baseUrl = "rule";
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
		if($this->user->can('list.'.str_slug($this->baseUrl))) {
			$all = $this->repository->all()
				->sortBy("id");
			return view((view()->exists($this->baseUrl . '/index')
				? ($this->baseUrl . '/index')
				: 'index'
			), [
				'baseUrl' => $this->baseUrl,
				'modelName' => $this->modelName,
				'models' => $all ? $all : [],
				'route' => $route
			]);
		}
		abort(403, 'Unauthorized action.');
	}
}
