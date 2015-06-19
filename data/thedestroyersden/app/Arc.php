<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Navigatable;
use App\BaseModel;
use App\Fillable;
class Arc extends BaseModel implements NavigatableContract {
	use Navigatable;
	use Fillable;
	public $fillable = [
		'start_time',
		'end_time'
	];
	public $relationMethods = ['playerCharacters','expenditures','economy','sales'];
	public function playerCharacters() {
		return $this->morphedByMany ( 'App\PlayerCharacter' ,'attendable');
	}
	public function users() {
		return $this->morphedByMany ( 'App\User' ,'attendable');
	}
	
	/**
	 * return the set of people who attended a given Arc who did not play a
	 * PlayerCharacter
	 */
	public function nonPlayerCharacters() {
		$playerCharacterPlayers = $this->playerCharacters->each ( function ($eachPlayerCharacter) {
			return $eachPlayerCharacter->user();
		} );
		$users = $this->users ();
		if($users->count() == 0){
			$combinedUsers = $playerCharacterPlayers;
		}
		else if($playerCharacterPlayers->count() == 0){
			$combinedUsers = $users;
		}
		else if($users->count() > 0 && $playerCharacterPlayers->count() > 0){
			$combinedUsers = $users->merge($playerCharacterPlayers);
			$combinedUsers->unique ();
		}
		else{
			$combinedUsers = new Collection;
		}
		return $combinedUsers;
	}
	public function expenditures() {
		return $this->hasMany ( 'App\Expenditure' );
	}
	public function economy() {
		return $this->belongsTo ( 'App\Economy' );
	}
	public function sales(){
		return $this->hasMany('App\Sale');
	}
}