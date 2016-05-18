<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use App\Repositories\DescriptionRepository;

class DescriptionController extends BaseController {
	function __construct(DescriptionRepository $repository) {
		$this->repository = $repository;
	}
}
