<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use App\Repositories\CraftRepository;

class CraftController extends BaseController {
	public function __construct(CraftRepository $repository) {
		$this->repository = $repository;
		parent::__construct ();
	}
}

?>