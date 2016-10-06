<?php

namespace App\Http\Controllers;

use App\Repositories\LinkRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Route;

class LinkController extends BaseController{
	public function __construct(LinkRepository $repository) {
		$this->repository = $repository;
		parent::__construct ();

		$this->modelName = class_basename ( $this->repository->model () );
		$this->baseUrl = "link";
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
			$all = $this->repository->all()->filter(function($eachLink){
				if($eachLink->menuItem->first()->menu->name == 'Rules')
					return true;
				return false;
			});
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
