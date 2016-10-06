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
Route::group(['middleware' => ['secure','auth']],function(){
	return [
		'order'=>Route::resource ( 'order', 'OrderController' ),
		'payment/square'=>Route::controller('payment/square','Payment\SquareController'),
		'user' => Route::resource ( 'user', 'UserController' )
	];
});
Route::group(['middleware' => 'secure'],function(){
	Route::controllers ( [
		'amazon' => 'AmazonController',
		'auth' => 'Auth\AuthController',
		'password' => 'Auth\PasswordController',
		'square'=>'SquareController'
	]);
});
Route::group(['middleware' => 'captchad'],function(){
	Route::post('contact', 'ContactController@store' );
});
Route::controller('book',"BookController");
Route::resource ( 'captchad', 'MyCaptchaController' );
Route::resource ( 'contact', 'ContactController' );
Route::resource ( 'arithmeticoperator', 'ArithmeticOperatorController' );
Route::resource ( 'arc', 'ArcController' );
Route::resource ( 'characterclass', 'CharacterClassController' );
Route::resource ( 'cost', 'CostController' );
Route::resource ( 'craftingcomponent', 'CraftingComponentController' );
Route::resource ( 'craftingrequirement', 'CraftingRequirementController' );
Route::resource ( 'craft', 'CraftController' );
Route::resource ( 'damagetype', 'DamageTypeController' );
Route::resource ( 'deity', 'DeityController' );
Route::resource ( 'devotional', 'DevotionalController' );
Route::any('description/search','DescriptionController@search');
Route::resource ( 'description', 'DescriptionController' );
Route::resource ( 'economy', 'EconomyController' );
Route::resource ( 'expenditures', 'ExpendituresController' );
Route::resource ( 'event', 'EventController' );
Route::resource ( 'google','GoogleController');
Route::resource ( 'item', 'ItemController' );
Route::resource ( 'itemtype', 'ItemTypeController' );
Route::resource ( 'link', 'LinkController' );
Route::resource ( 'homeland', 'HomelandController' );
Route::resource ( 'magic', 'MagicController' );
Route::resource ( 'menu', 'MenuController' );
Route::resource ( 'playercharacter', 'PlayerCharacterController' );
Route::resource ( 'race', 'RaceController' );
Route::resource ( 'rawresource', 'RawResourceController' );
Route::resource ( 'requirement', 'RequirementController' );
Route::resource ( 'requirementgroup', 'RequirementGroupController' );
Route::resource ( 'rule', 'RuleController' );
Route::resource ( 'sale', 'SaleController' );
Route::resource ( 'skill', 'SkillController' );
Route::resource ( 'skilltype', 'SkillTypeController' );
Route::resource ( 'spell', 'SpellController' );
Route::resource ( 'ticket', 'TicketController' );
Route::resource ( 'tool', 'ToolController' );
Route::resource ( 'weapon', 'WeaponController' );

/* Facebook */
Route::any ( 'facebook/login', 'FacebookController@login' );
Route::any ( 'facebook/login-callback', 'FacebookController@loginCallback' );
Route::any ( 'facebook/events', 'FacebookController@events' );
/* Like */
Route::any('like/toggle-like/{likeable_type}/{likeable_id}','LikeController@anyToggleLike');
/* form macros */
require app_path () . '/macros.php';
