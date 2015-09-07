<?php

namespace App\Http\Controllers;
use Tuurbo\AmazonPayment\AmazonPayment;
use Tuurbo\AmazonPayment\AmazonPaymentClient;
use Order;
use Request;
use View;

class AmazonController extends Controller{
	public function postMakePayment(\Request $request){
		// get access token
		$accessToken = $request->input('access_token');

		// get amazon order id
		$amazonReferenceId = $request->input('reference_id');

		try {

			// get user details
			$amazonUser = AmazonPayment::getLoginDetails($accessToken);

		} catch (\Exception $e) {

			// Redirect back to cart page if error
			return Redirect::to('/cart')
				->with('failure_message', 'Failed to connect to your Amazon account. Please try again.');

		}

		// create customers order
		$order = new Order;
		$order->processor = 'amazon';
		$order->reference_id = $amazonReferenceId;
		$order->save();

		try {
			$order->execute();
			// set amazon order details
			AmazonPayment::setOrderDetails([
				'referenceId' => $amazonReferenceId,
				'amount' => $order->final_total,
				'orderId' => $order->id,
				// optional note from customer
				'note' => $request->input('note')
			]);

			// comfirm the amazon order
			AmazonPayment::confirmOrder([
				'referenceId' => $amazonReferenceId,
			]);

			// get amazon order details and
			// save the response to your customers order
			$amazon = AmazonPayment::getOrderDetails([
				'referenceId' => $amazonReferenceId,
			]);
/* address irrelevant; saving for future use.
			$address = $amazon['details']['Destination']['PhysicalDestination'];

			// Update the order address, city, etc...
			$order->shipping_city = $address['City'];
			$order->shipping_state = $address['StateOrRegion'];
		
*/
			$order->approved = true;
			$order->save();
		} catch (\Exception $e) {

			// log error.
			// tell customer something went wrong.
			// maybe delete or rollback your websites internal order in the database since it wasn't approved by Amazon 
			$order->failed = true;
			$order->save();
		}
	}
	public function getCheckout(\Request $request){
		// get access token
		$accessToken = $request->input('access_token');

		try {

			// get user details, use them if needed
			$amazonUser = AmazonPayment::getLoginDetails($accessToken);

			// Laravel Auth example:
			// login user if their Amazon user_id is found in your users table
			// Obviously for this to work, you would have created the user entry at some other point in your app, maybe the account register page or something
			$user = User::where('amazon_id', $amazonUser['user_id'])->first();

			// If user is found, log them in
			if ($user) {
				Auth::loginUsingId($user->id);
			}

		} catch (\Exception $e) {

			// Redirect back to cart page if error
			return Redirect::to('/cart')
				->with('failure_message', 'Failed to connect to your Amazon account. Please try again.');

		}
		return View::make('amazon.checkout',['order'=>$order]);
	}
	public function getPaymentConfirmation(\Request $request){
		//@@todo
	}
	public function getPaymentAbandoned(\Request $request){
		//@@todo
	}
	public function postInstantPaymentNotification(\Request $request){
		//@@todo
	}
	public function getPrivacyNotice(){
		return \View::make('amazon.privacy');
	}
	public function getReturn(){
		//@todo
	}
}