<?php
/**
 * Created by PhpStorm.
 * User: austi_000
 * Date: 6/16/2016
 * Time: 2:01 PM
 */

namespace App\Http\Composers;
use Auth;
use App\User;
use Illuminate\View\View;

class CartComposer
{/**
 * AppComposer constructor.
 */
	public function __construct()
	{

	}
	public function compose(){
		if(Auth::guest()){
			$this->user = User::findOrFail(1);
		}
		else{
			$this->user = Auth::user();
		}
		$this->user->cart = $this->user->queryCart();
		if(!$this->user->cart)
			$this->user->cart = $this->user->createCart();
	}
}
