<?php

namespace App\Http\Controllers;

use Illuminate\Container\Container as App;
use Illuminate\Routing\Route;
use App\Repositories\EventRepository;

class EventController extends BaseController {
	public function __construct(EventRepository $repository) {
		$this->repository = $repository;
		parent::__construct ();
	}
}