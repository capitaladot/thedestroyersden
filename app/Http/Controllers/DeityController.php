<?php

namespace App\Http\Controllers;

use App\Repositories\DeityRepository;
use Illuminate\Routing\Route;

class DeityController extends BaseController {
	function __construct(DeityRepository $repository) {
		$this->repository = $repository;
		parent::__construct();
	}
}
