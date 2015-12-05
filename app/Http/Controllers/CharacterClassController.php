<?php

namespace App\Http\Controllers;
use App\Repositories\CharacterClassRepository;
use App\CharacterClass;

use Illuminate\Routing\Route;

class CharacterClassController extends BaseController {
	public function __construct(CharacterClassRepository $repository){
		$this->repository = $repository;
		parent::__construct();
	}
}

?>