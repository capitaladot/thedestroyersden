<?php

namespace App\Http\Controllers;

use App\Repositories\ItemTypeRepository;
use Illuminate\Routing\Route;

class ItemTypeController extends BaseController {
	function __construct(ItemTypeRepository $repository) {
		$this->repository = $repository;
		parent::__construct();
	}
}
