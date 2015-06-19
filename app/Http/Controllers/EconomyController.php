<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use App\Repositories\EconomyRepository;

class EconomyController extends BaseController {
	function __construct(EconomyRepository $repository) {
		$this->repository = $repository;
	}
}