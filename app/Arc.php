<?php

namespace App;

use App\Traits\Relatable;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Traits\Navigatable; 
use App\Traits\Presentable;
use McCool\LaravelAutoPresenter\HasPresenter;
use App\Traits\Fillable;

class Arc extends BaseModel implements HasPresenter, NavigatableContract {
	use Fillable;
	use Navigatable; 
	use Presentable;
	use Relatable;

	public $fillable = [ 
			'start_time',
			'end_time',
			'event_id'
	];
	public $relationMethods = [ 
			'event',
			'playerCharacters',
			'expenditures',
			'economy',
			'sales',
			'tickets'
	];
	/**
	 * return the set of people who attended a given Arc who did not play a
	 * PlayerCharacter
	 */
	public function nonPlayerCharacters() {
		$playerCharacterPlayers = $this->playerCharacters->each ( function ($eachPlayerCharacter) {
			return $eachPlayerCharacter->user ();
		} );
		$users = $this->users ();
		if ($users->count () == 0) {
			$combinedUsers = $playerCharacterPlayers;
		} else if ($playerCharacterPlayers->count () == 0) {
			$combinedUsers = $users;
		} else if ($users->count () > 0 && $playerCharacterPlayers->count () > 0) {
			$combinedUsers = $users->merge ( $playerCharacterPlayers );
			$combinedUsers->unique ();
		} else {
			$combinedUsers = new Collection ();
		}
		return $combinedUsers;
	}
	//relations
	public function playerCharacters() {
		return $this->morphedByMany ( 'App\PlayerCharacter', 'attendable' );
	}
	public function users() {
		return $this->morphedByMany ( 'App\User', 'attendable' );
	}
	public function tickets(){
		return $this->hasMany ('App\Ticket');
	}
	public function expenditures() {
		return $this->hasMany ( 'App\Expenditure' );
	}
	public function economy() {
		return $this->belongsTo ( 'App\Economy' );
	}
	public function event() {
		return $this->belongsTo ( 'App\Event' );
	}
	public function sales() {
		return $this->hasMany ( 'App\Sale' );
	}
}
