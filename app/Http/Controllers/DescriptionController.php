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
		$result = $this->repository->model->get();
		$result = $result->filter(function($eachResultModel)use($request){
			$terms = explode(" ",$request->input('terms'));
			foreach($terms as $eachTerm){
				if(false !== stristr($eachResultModel->title,$eachTerm) || false !== stristr($eachResultModel->body,$eachTerm))
					return true;
			}
		});
		return view('description.search',['terms'=>$request->input('terms'),'count'=>count($result),'models'=>$result
		]);
	}
}
