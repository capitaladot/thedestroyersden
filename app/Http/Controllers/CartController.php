<?php

namespace App\Http\Controllers;

use App\Order;
use App\PlayerCharacter;
use App\Ticket;
use Session;
class CartController extends Controller{
	public function __construct(){
		$this->cart = Order::findOrFail(\Session::get('cart'));
		return parent::__construct();
	}
	public function getIndex(Route $route){
		return view ( 'index', [ 
			'modelName' => 'tickets',
			'models' => $this->cart->tickets() ? $this->cart->tickets() : [ ],
			'route' => $route 
		] );
	}
	public function postAddTicket(PlayerCharacter $playerCharacter){
		return $this->cart->tickets(Ticket::create(['player_character_id'=>$playerCharacter->id,'order_id'=>$this->cart->id]));
	}
	public function postRemoveTicket(Ticket $ticket){
		return $ticket->delete();
	}
}