<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Repositories\UserRepository;

class UserController extends BaseController {
	public function __construct(UserRepository $repository) {
		$this->repository = $repository;
		parent::__construct ();
	}
}