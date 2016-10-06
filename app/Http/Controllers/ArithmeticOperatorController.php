<?php

namespace App\Http\Controllers;

use App\Repositories\ArithmeticOperatorRepository;
use Illuminate\Routing\Route;

class ArithmeticOperatorController extends BaseController {
	function __construct(ArithmeticOperatorRepository $repository) {
		$this->repository = $repository;
		parent::__construct();
	}
}
