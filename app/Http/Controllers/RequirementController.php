<?php

namespace App\Http\Controllers;

use App\Repositories\RequirementRepository;
use Illuminate\Routing\Route;

class RequirementController extends BaseController {
	function __construct(RequirementRepository $repository) {
		$this->repository = $repository;
		parent::__construct();
	}
}
