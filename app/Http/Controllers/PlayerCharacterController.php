<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use App\Repositories\PlayerCharacterRepository;

class PlayerCharacterController extends BaseController {
	function __construct(PlayerCharacterRepository $repository) {
		$this->repository = $repository;
	}
}

?>