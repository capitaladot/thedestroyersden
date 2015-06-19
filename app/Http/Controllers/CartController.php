<?php

namespace App\Http\Controllers;
use App\Order;
use Session;
class CartController extends Controller{
	public function getIndex(){
		$orderId = \Session::get('cart');
		dd(Order::findOrFail($orderId));
	}
}