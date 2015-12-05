<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk as LaravelFacebookSdk;
use App\User;
use App\Event;
use Flash;
use Illuminate\Support\Facades\Session as Session;
use Illuminate\Support\Facades\Auth as Auth;
use Facebook\GraphNodes\GraphObjectFactory;
use Facebook\GraphNodes\GraphObject;
use Log;
use Doctrine\Common\Proxy\Exception\UnexpectedValueException;
use Redirect;
use Request;
use Input;
class FacebookController extends Controller {
	function loginCallback(LaravelFacebookSdk $fb) {
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
	function paymentCallback(LaravelFacebookSdk $fb,Request $request){
		dd($fb,$request);
		return response($request->input('hub.challenge'),200);
	}
	/**
	@desc stores Facebook events from the configured group in the database and associates them to a user, creating that user if necessary.
	**/
	protected function storeFacebookEvent(GraphObject $event,LaravelFacebookSdk $fb, Route $route){
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
		Log::info('Storing event from Facebook group: '.$ownedEventData['name']);
		$eventModel = Event::where ( 'facebook_id', '=', $eventDataArray ['id'] )->firstOrFail ();
		// dd ( $eventModel );
		$eventModel->owner ()->associate ( $owner )->save ();
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
				return Redirect::to('auth/login')->with('errors', ['Facebook login required.']);
			}
		}
		$fb->setDefaultAccessToken ( $token );
		$response = $fb->get ( config ( 'services.facebook.pageId' ) . "/events?since=2014-10-01T18%3A30%3A00.000Z&until=2017-10-01T18%3A30%3A00.000Z&limit=1000" );
		$gof = new GraphObjectFactory ( $response );
		$events = $gof->makeGraphList ();
		//dd($events);
		Log::info('Facebook events response from '.config ( 'services.facebook.pageId' ) . "/events" ,[$events]);
		if(!empty($events))
			foreach ( $events as $event ) {
				if(!empty($event)){
					Log::info('Storing Facebook event',[$event]);
					$this->storeFacebookEvent($event, $fb, $route);
				}
			}
		$all = Event::all ();
		return view ( 'facebook.event.index', [ 
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