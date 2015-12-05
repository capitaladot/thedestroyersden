<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use App\Repositories\RaceRepository;

class RaceController extends BaseController {
	public function __construct(RaceRepository $repository){
		$this->repository = $repository;
		parent::__construct();
	}
}

?>