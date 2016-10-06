<?php

namespace App\Http\Controllers;

use App\Repositories\RequirementGroupRepository;
use Illuminate\Routing\Route;

class RequirementGroupController extends BaseController {
	function __construct(RequirementGroupRepository $repository) {
		$this->repository = $repository;
		parent::__construct();
	}
}
