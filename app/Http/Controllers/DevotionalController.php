<?php

namespace App\Http\Controllers;

use App\Repositories\DevotiionalRepository;
use Illuminate\Routing\Route;

class DevotionalController extends BaseController {
	function __construct(DevotionalRepository $repository) {
		$this->repository = $repository;
		parent::__construct();
	}
}
