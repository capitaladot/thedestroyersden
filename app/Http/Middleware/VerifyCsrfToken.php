<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Illuminate\Session\TokenMismatchException;

class VerifyCsrfToken extends BaseVerifier {
	
	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request        	
	 * @param \Closure $next        	
	 * @return mixed
	 *
	 * @throws TokenMismatchException
	 */
	public function handle($request, Closure $next) {
		if ($this->isReading ( $request ) || $this->excludedRoutes ( $request ) || $this->tokensMatch ( $request )) {
			return $this->addCookieToResponse ( $request, $next ( $request ) );
		}
		
		throw new TokenMismatchException ();
	}
	/**
	 * Ignore CSRF on these routes.
	 *
	 * @param \Illuminate\Http\Request $request        	
	 * @return bool
	 */
	private function excludedRoutes($request) {
		$routes = [ 
				'facebook/callback' 
		];
		// ... insert all your canvas endpoints here
		
		foreach ( $routes as $route ) {
			if ($request->is ( $route )) {
				return true;
			}
		}
		
		return false;
	}
}
