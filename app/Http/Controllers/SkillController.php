<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use App\Repositories\SkillRepository;

class SkillController extends BaseController {
	public function __construct(SkillRepository $repository) {
		$this->repository = $repository;
		parent::__construct ();
	}
}
