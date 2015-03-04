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
		'auth' => 'Auth\AuthController',
		'password' => 'Auth\PasswordController'
] );
Route::resource ( 'arc', 'ArcController' );
Route::resource ( 'characterclass', 'CharacterClassController' );
Route::resource ( 'cost', 'CostController' );
Route::resource ( 'craftingcomponent', 'CraftingComponentController' );
Route::resource ( 'craftingrequirement', 'CraftingRequirementController' );
Route::resource ( 'craft', 'CraftController' );
Route::resource ( 'economy', 'EconomyController' );
Route::resource ( 'expenditures', 'ExpendituresController' );
Route::resource ( 'finalproduct', 'FinalProductController' );
Route::resource ( 'homeland', 'HomelandController' );
Route::resource ( 'playercharacter', 'PlayerCharacterController' );
Route::resource ( 'race', 'RaceController' );
Route::resource ( 'rawresource', 'RawResourceController' );
Route::resource ( 'sale', 'SaleController' );
Route::resource ( 'skill', 'SkillController' );
Route::resource ( 'tool', 'ToolController' );
Route::resource ( 'user', 'UserController' );

/* form macros */
require app_path().'/macros.php';