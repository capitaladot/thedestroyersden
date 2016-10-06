<?php

namespace App\Http\Controllers;

use App\Repositories\MagicRepository;
use Illuminate\Routing\Route;

class MagicController extends BaseController {
	function __construct(MagicRepository $repository) {
		$this->repository = $repository;
		parent::__construct();
	}
}
