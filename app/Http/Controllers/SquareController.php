<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Log;

class SquareController extends Controller
{
	const WEBHOOK_URL = 'https://destroyersden.com/square/webhooks';
	/**
	 * @param Request $request
	 */
	public function postPaymentCallback(Request $request){
		Log::debug("[Square Payment Callback]",$request->all());
	}

	/**
	 * @param Request $request
	 */
	public function postWebhooks(Request $request){
		/*
		 *  'entity_id' => '5a350fb3-2b90-4970-6080-0636e83c777b',
			  'event_type' => 'TEST_NOTIFICATION',
  			'merchant_id' => '50WR67ZSMB9Q0',
		 * */
		if($this->isValidCallback($request->getContent(),$request->header('X-Square-Signature') )){
			switch($request->event_type){
				case "PAYMENT_UPDATED":
					break;
			}
		}
		Log::debug("[Square Webhook]",$request->all());
	}

	/** @desc Validates HMAC-SHA1 signatures included in webhook notifications to ensure notifications came from Square
	 * @param $callbackBody
	 * @param $callbackSignature
	 * @return bool
	 */
	function isValidCallback($callbackBody, $callbackSignature) {
		# Combine your webhook notification URL and the JSON body of the incoming request into a single string
		$stringToSign = self::WEBHOOK_URL . $callbackBody;
		# Generate the HMAC-SHA1 signature of the string, signed with your webhook signature key
		$stringSignature = base64_encode(hash_hmac('sha1', $stringToSign,config('square.signature_key'), true));
		# Hash the signatures a second time (to protect against timing attacks)
		# and compare them
		return (sha1($stringSignature) === sha1($callbackSignature));
	}
}
