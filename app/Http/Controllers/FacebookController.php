<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk as LaravelFacebookSdk;
use App\User;
use App\Event;
use Illuminate\Support\Facades\Session as Session;
use Illuminate\Support\Facades\Auth as Auth;
use Facebook\GraphNodes\GraphObjectFactory;
use Facebook\GraphNodes\GraphObject;
use Doctrine\Common\Proxy\Exception\UnexpectedValueException;

class FacebookController extends Controller {
	function callback(LaravelFacebookSdk $fb) {
		// Obtain an access token.
		try {
			$token = $fb->getAccessTokenFromRedirect ();
		} catch ( Facebook\Exceptions\FacebookSDKException $e ) {
			dd ( $e->getMessage () );
		}
		
		// Access token will be null if the user denied the request
		// or if someone just hit this URL outside of the OAuth flow.
		if (! $token) {
			// Get the redirect helper
			$helper = $fb->getRedirectLoginHelper ();
			
			if (! $helper->getError ()) {
				abort ( 403, 'Unauthorized action.' );
			}
			
			// User denied the request
			dd ( $helper->getError (), $helper->getErrorCode (), $helper->getErrorReason (), $helper->getErrorDescription () );
		}
		
		if (! $token->isLongLived ()) {
			// OAuth 2.0 client handler
			$oauth_client = $fb->getOAuth2Client ();
			
			// Extend the access token.
			try {
				$token = $oauth_client->getLongLivedAccessToken ( $token );
			} catch ( Facebook\Exceptions\FacebookSDKException $e ) {
				dd ( $e->getMessage () );
			}
		}
		
		$fb->setDefaultAccessToken ( $token );
		
		// Save for later
		Session::put ( 'facebook_access_token', ( string ) $token );
		
		// Get basic info on the user from Facebook.
		try {
			$response = $fb->get ( '/me?fields=id,name,email' );
		} catch ( Facebook\Exceptions\FacebookSDKException $e ) {
			dd ( $e->getMessage () );
		}
		
		// Convert the response to a `Facebook/GraphNodes/GraphUser` collection
		$facebook_user = $response->getGraphUser ();
		
		// Create the user if it does not exist or update the existing entry.
		// This will only work if you've added the SyncableGraphNodeTrait to your User model.
		$user = \App\User::createOrUpdateGraphNode ( $facebook_user );
		
		// Log the user into Laravel
		Auth::login ( $user );
		
		return redirect ( '/' )->with ( 'message', 'Successfully logged in with Facebook' );
	}
	/**
	 *
	 * @uses groupId from config.services.facebook
	 * @param LaravelFacebookSdk $fb        	
	 */
	function events(LaravelFacebookSdk $fb, Route $route) {
		$token = Session::get ( 'facebook_access_token' );
		if (empty ( $token )) {
			$helper = $fb->getRedirectLoginHelper ();
			
			if (! $helper->getError ()) {
				Flash::error ( 'Please login via Facebook before performing this action.' );
				die ();
			}
		}
		$fb->setDefaultAccessToken ( $token );
		$response = $fb->get ( config ( 'services.facebook.groupId' ) . "/events" );
		$gof = new GraphObjectFactory ( $response );
		$events = $gof->makeGraphList ();
		foreach ( $events as $event ) {
			$eventDataArray = $event->asArray ();
			$enrichedEventResponse = $fb->get ( $eventDataArray ['id'] . '?fields=owner,description,name,start_time,end_time,timezone,updated_time' );
			$enrichedEventData = $enrichedEventResponse->getGraphObject ();
			$ownedEventData = [ ];
			foreach ( $enrichedEventData as $key => $value ) {
				if ($key == 'owner') {
					$userArray = $value->asArray ();
					$enrichedUser = $fb->get ( '/' . $userArray ['id'] . '?fields=name,id' )->getGraphUser ();
					$owner = User::createOrUpdateGraphNode ( $enrichedUser );
					if (! $owner)
						throw new UnexpectedValueException ( 'Owner not created!' );
				} else
					$ownedEventData [$key] = $value;
			}
			Event::createOrUpdateGraphNode ( $ownedEventData );
			$eventModel = Event::where ( 'facebook_id', '=', $eventDataArray ['id'] )->firstOrFail ();
			// dd ( $eventModel );
			$eventModel->owner ()->associate ( $owner )->save ();
		}
		$all = Event::all ();
		return view ( 'index', [ 
				'route' => $route,
				'modelName' => 'events',
				'models' => $all ? $all : [ ] 
		] );
	}
	public function getUserInfo(LaravelFacebookSdk $fb) {
		$token = Session::get ( 'facebook_access_token' );
		$fb->setDefaultAccessToken ( $token );
		try {
			$response = $fb->get ( '/me?fields=id,name,email' );
		} catch ( Facebook\Exceptions\FacebookSDKException $e ) {
			dd ( $e->getMessage () );
		}
		
		// Convert the response to a `Facebook/GraphNodes/GraphUser` collection
		$facebook_user = $response->getGraphUser ();
		
		// Create the user if it does not exist or update the existing entry.
		// This will only work if you've added the SyncableGraphNodeTrait to your User model.
		$user = User::createOrUpdateGraphNode ( $facebook_user );
		
		// Log the user into Laravel
		Auth::login ( $user );
	}
}

?>