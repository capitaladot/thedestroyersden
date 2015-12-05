<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use App\MainMenu;
use App\Repositories\MenuRepository;
class MenuController extends BaseController {
	public function __construct(MenuRepository $repository) {
		$this->repository = $repository;
		parent::__construct ();
	}
}

?>