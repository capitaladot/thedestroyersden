<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use App\Repositories\DescriptionRepository;
use App\Description;
use Sleimanx2\Plastic\Searchable;
use Illuminate\Http\Request;

class DescriptionController extends BaseController {
	function __construct(DescriptionRepository $repository) {
		$this->repository = $repository;
		return parent::__construct();
	}
	public function search(Request $request){
		//$this->repository->model->document()->reindex($this->repository->model->all());
		$result = $this->repository->model
			->search()
			->size(1000)
			->should()
			->match('body',explode(" ",$request->input('terms')))
			->match('title',explode(" ",$request->input('terms')))
			->get();
		return view('description.search',['terms'=>$request->input('terms'),'count'=>count($result->hits()),'models'=>$result->hits()
		]);
	}
}
