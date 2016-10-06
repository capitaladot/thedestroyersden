<?php
namespace App\Http\Controllers;

use App\Repositories\SpellRepository;

class SpellController extends BaseController
{
	function __construct(SpellRepository $repository) {
		$this->repository = $repository;
		parent::__construct();
	}
}
