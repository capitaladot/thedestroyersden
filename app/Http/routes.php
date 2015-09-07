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
	return [Route::post('contact', 'ContactController@store' ),
	Route::patch('contact', 'ContactController@update' )];
});

Route::resource ( 'arc', 'ArcController' );
Route::resource ( 'character-class', 'CharacterClassController' );
Route::resource ( 'cost', 'CostController' );
Route::resource ( 'crafting-component', 'CraftingComponentController' );
Route::resource ( 'crafting-requirement', 'CraftingRequirementController' );
Route::resource ( 'craft', 'CraftController' );
Route::resource ( 'economy', 'EconomyController' );
Route::resource ( 'expenditures', 'ExpendituresController' );
Route::resource ( 'event', 'EventController' );
Route::resource ( 'final-product', 'FinalProductController' );
Route::resource ( 'homeland', 'HomelandController' );
Route::resource ( 'player-character', 'PlayerCharacterController' );
Route::resource ( 'race', 'RaceController' );
Route::resource ( 'raw-resource', 'RawResourceController' );
Route::resource ( 'sale', 'SaleController' );
Route::resource ( 'skill', 'SkillController' );
Route::resource ( 'tool', 'ToolController' );

/* Facebook */
Route::get ( 'facebook/login', 'FacebookController@login' );
Route::get ( 'facebook/callback', 'FacebookController@callback' );
Route::get ( 'facebook/events', 'FacebookController@events' );
/* form macros */
require app_path () . '/macros.php';