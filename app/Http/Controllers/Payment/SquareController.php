<?php
/**
 * Created by PhpStorm.
 * User: austi_000
 * Date: 6/5/2016
 * Time: 9:05 AM
 */

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller as Controller;
use App\Processor;
use SquareConnect\ApiException;
use SquareConnect\Api\LocationApi;
use SquareConnect\Model\Tender;
use SquareConnect\Api\TransactionApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;
use Session;
use Mail;

class SquareController extends Controller
{
	public function __construct()
	{
		$this->square = Processor::where('title','Square')->firstOrFail();
	}

	public function getCard(Request $request){

		return view('square.card',['square'=>$this->square]);
	}
	public function getProcess(Request $request){
		$access_token = config("square.access_token");
		$location_api = new LocationApi();
		$locationResponse = $location_api->listLocations($access_token);
		$locations = collect($locationResponse->getLocations())->filter(function($eachLocation){
			$capabilities = $eachLocation->getCapabilities();
			if(!is_null($capabilities)) {
				return in_array('CREDIT_CARD_PROCESSING',$capabilities);
			}
			return false;
		});
		$location_id = $locations->first()->getID();
		# Charging the card nonce
		# Assume you have assigned values to the following variables:
		#   $nonce
		#   $location_id
		#   $access_token
		$transaction_api = new TransactionApi();
		if(Session::get("idempotency_key")){
			$idempotencyKey = Session::get("idempotency_key");
		}
		else {
			$idempotencyKey = uniqid();
			Session::put("idempotency_key", $idempotencyKey);
		}
		$cart = Auth::user()->queryCart();
		$request_body = array (
			"card_nonce" => $request->nonce,
			# Monetary amounts are specified in the smallest unit of the applicable currency.
			# This amount is in cents. It's also hard-coded for $1, which is not very useful.
			"amount_money" => array (
				"amount" => $cart->currentTotal()  * 100,
				"currency" => "USD"
			),
			# Every payment you process for a given business have a unique idempotency key.
			# If you're unsure whether a particular payment succeeded, you can reattempt
			# it with the same idempotency key without worrying about double charging
			# the buyer.
			"idempotency_key" => $idempotencyKey
		);
# The SDK throws an exception if a Connect endpoint responds with anything besides 200 (success).
# This block catches any exceptions that occur from the request.
		try {
			$transactionResponse = $transaction_api->charge($access_token, $location_id, $request_body);
			$errors = $transactionResponse->getErrors();
			if(empty($errors)){
				$transaction = $transactionResponse->getTransaction();
				$tender = collect($transaction->getTenders())->first();
				$cart->execute($this->square,$tender->getTransactionId());
				return redirect($cart->getUrl());
			}
			else throw new \ErrorException(collect($errors->getErrors())->toJson());
		} catch (Exception $e) {
			try{
				Log::error("Payment failed; marking cart as failed. ".$e->getMessage());
				$cart->failed = true;
				$cart->save();
				if(!empty(Auth::user()->email)){
					$sent = Mail::send('emails.order.executed',
					[
						'order'=>$cart
					], function($message)use($request)
					{
						$message->from('destroyersdenlarp@gmail.com','DestroyersDen.com');
						$message->to(Auth::user()->email,Auth::user()->title);
						$message->cc('destroyersdenlarp@gmail.com', 'Destroyers Den Staff Gmail')
							->subject('Order Received on the Website');
					});
				}
			}
			catch(Exception $ee){
				Log::critical("Exception thrown handling payment failure! ".$ee->getMessage(),$e);
			}
		}
		catch(ApiException $ae){
			if(empty($errors))
				$errors = collect($ae->getResponseBody()->errors);
			if($errors->first()->code == "CARD_TOKEN_USED"){
				$redirect = redirect()->back()->withInput();
				if(!empty($errors))
					$redirect->withErrors($errors);
				return $redirect;
			}
			$cart->failed = true;
			$cart->save();
			\ddd($ae->getMessage(),$ae);
		}
	}
}
