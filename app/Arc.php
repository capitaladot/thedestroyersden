<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\Navigatable; 
use App\Traits\Presentable;
use App\BaseModel; 
use McCool\LaravelAutoPresenter\HasPresenter;
use App\Traits\Fillable;

class Arc extends BaseModel implements HasPresenter, NavigatableContract {
	use Fillable;
	use Navigatable; 
	use Presentable;
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
			'sales' 
	];
	public function playerCharacters() {
		return $this->morphedByMany ( 'App\PlayerCharacter', 'attendable' );
	}
	public function users() {
		return $this->morphedByMany ( 'App\User', 'attendable' );
	}
	
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