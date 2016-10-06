<?php

namespace App;

// contracts
use App\Traits\Relatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
// traits
use Illuminate\Auth\Authenticatable as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPassword;
use App\Traits\Attendable;
use App\Traits\Fillable;
use App\Traits\Navigatable; 
use App\Traits\Presentable;
use SammyK\LaravelFacebookSdk\SyncableGraphNodeTrait as SyncableGraphNodeTrait;
use Bican\Roles\Traits\HasRoleAndPermission as HasRoleAndPermissionTrait;
// related
use App\Order;
use App\Role;

class User extends BaseModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, HasRoleAndPermissionContract, NavigatableContract {
	use Attendable;
	use Authenticatable;
	use CanResetPassword;
	use Fillable;
	use HasRoleAndPermissionTrait;
	use Navigatable; 
	use Presentable;
	use Relatable;
	use SyncableGraphNodeTrait;
	
	public $cart = null;
	protected static $graph_node_field_aliases = [ 
		'id' => 'facebook_id',
		'name' => 'name',
		'access_token' => 'access_token' 
	];
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
	public $fillable = [
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
	public $hidden = [
			'remember_token',
			'access_token',
			'slug' 
	];
	public $relationMethods = [ 
			'events',
			'playerCharacters',
			'orders',
			'roles'
	];
	public function __construct(array $attributes = [])
	{
		$parentConstructed = parent::__construct($attributes);
		static::created(function($user){
			$user->createCart();
			$user->roles()->attach(Role::where(['name'=>'user'])->first()->id);
		});
		return $parentConstructed;
	}	
	public function createCart(){
		$cart = new Order;
		$cart->save();
		$this->orders()->save($cart);
		\Session::put($cart->id);
		return $cart;
	}
	public function queryCart(){
		return $this->orders()->where('executed',0)->where('failed',0)->first();
	}
	/**
	 * Override getTitle from Navigatable since user objects have slightly different parameters.
	 *
	 * @return string @@todo: add role decoration here.
	 */
	public function getTitle() {
		return $this->name . '(' . $this->title . ')';
	}
	//relations
	public function events() {
		return $this->hasMany ( 'App\Event', 'owner_id' );
	}
	public function playerCharacters() {
		return $this->hasMany ( 'App\PlayerCharacter' );
	}
	public function orders(){
		return $this->hasMany('App\Order');
	}
}
