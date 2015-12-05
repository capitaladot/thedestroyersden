<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use App\Repositories\HomelandRepository;

class HomelandController extends BaseController {
	public function __construct(HomelandRepository $repository){
		$this->repository = $repository;
		parent::__construct();
	}
}

?>