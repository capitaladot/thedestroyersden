<?php

namespace App\Http\Controllers;

use App\Repositories\ToolRepository;
use Illuminate\Routing\Route;

class ToolController extends BaseController {
	public function __construct(ToolRepository $toolRepository){
		$this->repository = $toolRepository;
		parent::__construct();
	}
}

?>