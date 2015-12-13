<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use App\Repositories\RawResourceRepository;

class RawResourceController extends BaseController {
	public function __construct(RawResourceRepository $repository){
		$this->repository = $repository;
		parent::__construct();
	}
}
?>