<?php namespace App;
use App\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Ticket extends BaseModel {

	public $fillable = ['redeemed_at'];
	public function playerCharacter(){
		return $this->belongsTo('App\PlayerCharacter');
	}
	public function order(){
		return $this->belongsTo('App\Order');
	}

}
