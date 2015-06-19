<?php namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
		'App\Http\Middleware\VerifyCsrfToken',
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'amazon' => 'App\Http\Middleware\Secure',
		'auth' => ['App\Http\Middleware\Authenticate','App\Http\Middleware\Secure'],
		'auth.basic' => ['Illuminate\Auth\Middleware\AuthenticateWithBasicAuth','App\Http\Middleware\Secure'],
		'cart' => 'App\Http\Middleware\Secure',
		'guest' => 'App\Http\Middleware\RedirectIfAuthenticated',
	];

}
