<?php

namespace App\Http\Controllers;

use App\Repositories\SkillTypeRepository;
use Illuminate\Routing\Route;

class SkillTypeController extends BaseController {
	function __construct(SkillTypeRepository $repository) {
		$this->repository = $repository;
		parent::__construct();
	}
}
