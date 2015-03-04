<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Navigatable;
use Illuminate\Auth\Authenticatable;
use App\BaseModel;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Attendable;
class User extends BaseModel implements AuthenticatableContract, CanResetPasswordContract, NavigatableContract {
	
	use Authenticatable;
	use CanResetPassword;
	use Navigatable;
	use Attendable;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'name',
			'email',
			'password',
			'title',
			'slug'
	];
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
			'password',
			'remember_token'
	];
	/**
	 * Override getTitle from Navigatable since user objects have slight different parameters.
	 * @return string
	 * @@todo: add role decoration here.
	 */
	public function getTitle(){
		return $this->name . '('.$this->title.')';
	}
	/**
	 * The list of items this user possesses.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function possessions() {
		return $this->morphMany ( 'App\Item', 'ownable' );
	}
}
