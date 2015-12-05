<?php

namespace App\Http\Controllers;

use App\Repositories\ArcRepository;
use Illuminate\Routing\Route;

class ArcController extends BaseController {
	function __construct(ArcRepository $repository) {
		$this->repository = $repository;
		parent::__construct();
	}
}