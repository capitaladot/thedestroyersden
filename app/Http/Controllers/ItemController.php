<?php

namespace App\Http\Controllers;
use App\Repositories\ItemRepository;
use Illuminate\Routing\Route;

class ItemController extends BaseController {
	public function __construct(ItemRepository $repository) {
		$this->repository = $repository;
		parent::__construct ();
	}
}
