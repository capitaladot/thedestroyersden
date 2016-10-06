<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use App\Repositories\CostRepository;

class CostController extends BaseController {
	function __construct(CostRepository $repository) {
		$this->repository = $repository;
		parent::__construct();
	}
}

?>
