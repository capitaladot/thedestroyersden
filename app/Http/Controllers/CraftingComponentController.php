<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use App\Repositories\CraftingComponentRepository;

class CraftingComponentController extends BaseController {
	public function __construct(CraftingComponentRepository $repository){
		$this->repository = $repository;
		parent::__construct();
	}
}
?>