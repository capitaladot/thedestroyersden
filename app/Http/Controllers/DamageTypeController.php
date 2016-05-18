<?php

namespace App\Http\Controllers;

use App\Repositories\DamageTypeRepository;
use Illuminate\Routing\Route;

class DamageTypeController extends BaseController {
	function __construct(DamageTypeRepository $repository) {
		$this->repository = $repository;
		parent::__construct();
	}
}