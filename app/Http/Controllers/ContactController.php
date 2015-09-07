<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent as Eloquent;
use App;
use Barryvdh\Debugbar\Facade as Debugbar;
use App\Http\Requests\ContactFormRequest;

class ContactController extends Controller{
	public function index(Route $route) {
		return view ( 'contact.form'); 
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Route $route) {
		return view ( 'contact.form'); 
	}
	public function update(ContactFormRequest $request){
		return $this->store($request);
	}
	public function store(ContactFormRequest $request)
	{
		$sent = \Mail::send('emails.contact',
        array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'user_message' => $request->get('message')
        ), function($message)use($request)
		{
			$message->from('website@destroyersden.com','Destroyersden.com');
			$message->cc($request->get('email'),$request->get('name'));
			$message->to('destroyersdenlarp@gmail.com', 'Destroyers Den Staff Gmail')->subject('Question from the Website');
		});
		return view('contact.submitted',['sent'=>$sent]);
  }
}