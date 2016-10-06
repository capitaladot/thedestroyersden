@extends('app')
@section('content')
	<h5 class="center-announcement"><label>Total</label>
	<span>${!! round(Auth()->user()->cart->currentTotal()* (1+$square->percentage)+$square->swipe,2) !!}</span>&nbsp;<small>(including Square Payment processing fee)</small></h5>
	<label>Card Number</label>
	<div id="sq-card-number"></div>
	<label>CVV</label>
	<div id="sq-cvv"></div>
	<label>Expiration Date</label>
	<div id="sq-expiration-date"></div>
	<label>Postal Code</label>
	<div id="sq-postal-code"></div>
	<button type="submit" onclick="requestCardNonce()">Submit</button>
@endsection
@section('bodyscripts')
	@parent
	<script type="text/javascript" src="https://js.squareup.com/v2/paymentform"></script>
	<script>
		var paymentForm = new SqPaymentForm({
			applicationId: '{!! config("square.application_id") !!}', // <-- Add your application ID here
			inputClass: 'sq-input',
			inputStyles: [
				{
					fontSize: '15px'
				}
			],
			cardNumber: {
				elementId: 'sq-card-number',
				placeholder: '•••• •••• •••• ••••'
			},
			cvv: {
				elementId: 'sq-cvv',
				placeholder: 'CVV'
			},
			expirationDate: {
				elementId: 'sq-expiration-date',
				placeholder: 'MM/YY'
			},
			postalCode: {
				elementId: 'sq-postal-code'
			},
			callbacks: {
				cardNonceResponseReceived: function(errors, nonce, cardData) {
					if (errors) {
						// handle errors
						errors.forEach(function(error) { console.log(error.message); });
					} else {
						// handle nonce
						console.log('Nonce received:');
						console.log(nonce);
						window.location.replace("{!! action('Payment\SquareController@getProcess') !!}?nonce="+nonce);
					}
				},
				unsupportedBrowserDetected: function() {
					// Alert the buyer that their browser is not supported
				},
				inputEventReceived: function(inputEvent) {
					switch (inputEvent.eventType) {
						case 'focusClassAdded':
							// Handle as desired
							break;
						case 'focusClassRemoved':
							// Handle as desired
							break;
						case 'errorClassAdded':
							// Handle as desired
							break;
						case 'errorClassRemoved':
							// Handle as desired
							break;
						case 'cardBrandChanged':
							// Handle as desired
							break;
						case 'postalCodeChanged':
							// Handle as desired
							break;
					}
				}
			}
		});

		function requestCardNonce() {
			paymentForm.requestCardNonce();
		}
	</script>
@endsection
