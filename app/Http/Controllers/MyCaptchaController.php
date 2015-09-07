<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent as Eloquent;
use App;
use Barryvdh\Debugbar\Facade as Debugbar;
use Captcha;
use Validator;

class MyCaptchaController extends Controller{
	public function index(Request $request) {
		return $this->create($request); 
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request) {
		return view ( 'captcha.form',['request'=>$request]); 
	}
	public function store(Request $request){
		return redirect()->back();
	}
}