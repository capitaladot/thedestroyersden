<?php

/*
 * |--------------------------------------------------------------------------
 * | Application Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register all of the routes for an application.
 * | It's a breeze. Simply tell Laravel the URIs it should respond to
 * | and give it the Closure to execute when that URI is requested.
 * |
 */
Route::get ( '/', function () {
	return View::make ( 'hello' );
} );
Route::get ( '/', 'WelcomeController@index' );
Route::get ( 'home', 'HomeController@index' );
Route::controllers ( [ 
	'amazon' => 'AmazonController',
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController' 
] );
Route::group(['middleware' => 'auth'],function(){
	return [
		'cart'=>Route::controller('cart', 'CartController'),
		'user' => Route::resource ( 'user', 'UserController' )
	];
});
Route::resource('captchad', 'MyCaptchaController' );
Route::resource('contact', 'ContactController' );
Route::group(['middleware' => 'captchad'],function(){
	return [Route::post('contact', 'ContactController@store' )/*,
	Route::post('auth*', 'AuthController' )*/];
});
Route::resource ( 'arithemeticoperator', 'ArithmeticOperatorController' );
Route::resource ( 'arc', 'ArcController' );
Route::resource ( 'characterclass', 'CharacterClassController' );
Route::resource ( 'cost', 'CostController' );
Route::resource ( 'craftingcomponent', 'CraftingComponentController' );
Route::resource ( 'craftingrequirement', 'CraftingRequirementController' );
Route::any('craft/trim','CraftController@trim');
Route::resource ( 'craft', 'CraftController' );
Route::resource ( 'damagetype', 'DamageTypeController' );
Route::resource ( 'description', 'DescriptionController' );
Route::resource ( 'economy', 'EconomyController' );
Route::resource ( 'expenditures', 'ExpendituresController' );
Route::resource ( 'event', 'EventController' );
Route::any('item/trim','ItemController@trim');
Route::resource('google','GoogleController');
Route::resource ( 'item', 'ItemController' );
Route::resource ( 'itemtype', 'ItemTypeController' );
Route::resource ( 'homeland', 'HomelandController' );
Route::resource ( 'menu', 'MenuController' );
Route::resource ( 'playercharacter', 'PlayerCharacterController' );
Route::resource ( 'race', 'RaceController' );
Route::resource ( 'rawresource', 'RawResourceController' );
Route::resource ( 'sale', 'SaleController' );
Route::resource ( 'skill', 'SkillController' );
Route::resource ( 'tool', 'ToolController' );
Route::resource ( 'weapon', 'WeaponController' );

/* Facebook */
Route::any ( 'facebook/login', 'FacebookController@login' );
Route::any ( 'facebook/login-callback', 'FacebookController@loginCallback' );
Route::any ( 'facebook/payment-callback', 'FacebookController@paymentCallback' );
Route::any ( 'facebook/events', 'FacebookController@events' );
/* Like */
Route::any('like/toggle-like/{likeable_type}/{likeable_id}','LikeController@anyToggleLike');
/* form macros */
require app_path () . '/macros.php';
