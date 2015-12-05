<?php
return [ 
		
		/*
		 * |--------------------------------------------------------------------------
		 * | Third Party Services
		 * |--------------------------------------------------------------------------
		 * |
		 * | This file is for storing the credentials for third party services such
		 * | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
		 * | default location for this type of information, allowing packages
		 * | to have a conventional place to find your various credentials.
		 * |
		 */
		'facebook' => [ 
				'groupId' => ***REMOVED***,
				'pageId' => ***REMOVED***
		],
		'mailgun' => [ 
				'domain' => '',
				'secret' => '' 
		],
		
		'mandrill' => [ 
				'secret' => '' 
		],
		
		'amazonpayment' => [
			'sandbox_mode' => true,
			'store_name' => 'The Destroyer\'s Den',
			'statement_name' => 'The Destroyer\'s Den 317-426-0120',
			'client_id' => '***REMOVED***',
			'seller_id' => '',
			'access_key' => '',
			'secret_key' => '***REMOVED***',
		],
		
		'ses' => [ 
				'key' => '',
				'secret' => '',
				'region' => 'us-east-1' 
		],
		
		'stripe' => [ 
				'model' => 'User',
				'secret' => '' 
		] 
];
