<?php
return [ 
		
		/*
		 * |--------------------------------------------------------------------------
		 * | Application Debug Mode
		 * |--------------------------------------------------------------------------
		 * |
		 * | When your application is in debug mode, detailed error messages
		 * with
		 * | stack traces will be shown on every error that occurs within your
		 * | application. If disabled, a simple generic error page is shown.
		 * |
		 */
		
		'debug' => env ( 'APP_DEBUG' ),
		'env' => env('APP_ENV', 'production'),

	/*
	|--------------------------------------------------------------------------
	| Application URL
	|--------------------------------------------------------------------------
	|
	| This URL is used by the console to properly generate URLs when using
	| the Artisan command line tool. You should set this to the root of
	| your application so that it is used when running Artisan tasks.
	|
	*/

	'url' => 'http://destroyersden.com',

	/*
	|--------------------------------------------------------------------------
	| Application Timezone
	|--------------------------------------------------------------------------
	|
	| Here you may specify the default timezone for your application, which
	| will be used by the PHP date and date-time functions. We have gone
	| ahead and set this to a sensible default for you out of the box.
	|
	*/

	'timezone' => 'America/New_York',

	/*
	|--------------------------------------------------------------------------
	| Application Locale Configuration
	|--------------------------------------------------------------------------
	|
	| The application locale determines the default locale that will be used
	| by the translation service provider. You are free to set this value
	| to any of the locales which will be supported by the application.
	|
	*/

	'locale' => 'en',

	/*
	|--------------------------------------------------------------------------
	| Application Fallback Locale
	|--------------------------------------------------------------------------
	|
	| The fallback locale determines the locale to use when the current one
	| is not available. You may change the value to correspond to any of
	| the language folders that are provided through your application.
	|
	*/

	'fallback_locale' => 'en',

	/*
	|--------------------------------------------------------------------------
	| Encryption Key
	|--------------------------------------------------------------------------
	|
	| This key is used by the Illuminate encrypter service and should be set
	| to a random, 32 character string, otherwise these encrypted strings
	| will not be safe. Please do this before deploying an application!
	|
	*/

	'key' => env ( 'APP_KEY', 'SomeRandomString' ),
		
		'cipher' => 'AES-256-CBC',

	/*
	|--------------------------------------------------------------------------
	| Logging Configuration
	|--------------------------------------------------------------------------
	|
	| Here you may configure the log settings for your application. Out of
	| the box, Laravel uses the Monolog PHP logging library. This gives
	| you a variety of powerful log handlers / formatters to utilize.
	|
	| Available Settings: "single", "daily", "syslog", "errorlog"
	|
	*/

	'log' => 'daily',

	/*
	|--------------------------------------------------------------------------
	| Autoloaded Service Providers
	|--------------------------------------------------------------------------
	|
	| The service providers listed here will be automatically loaded on the
	| request to your application. Feel free to add your own services to
	| this array to grant expanded functionality to your applications.
	|
	*/

	'providers' => [ 
				
				/*
				 * Laravel Framework Service Providers...
				 */
				Illuminate\Foundation\Providers\ArtisanServiceProvider::class,
				Illuminate\Auth\AuthServiceProvider::class,
				'Illuminate\Broadcasting\BroadcastServiceProvider',
				'Illuminate\Bus\BusServiceProvider',
				'Illuminate\Cache\CacheServiceProvider',
				'Illuminate\Foundation\Providers\ConsoleSupportServiceProvider',
				//'Illuminate\Routing\ControllerServiceProvider',
				'Illuminate\Cookie\CookieServiceProvider',
				'Illuminate\Database\DatabaseServiceProvider',
				'Illuminate\Encryption\EncryptionServiceProvider',
				'Illuminate\Filesystem\FilesystemServiceProvider',
				'Illuminate\Foundation\Providers\FoundationServiceProvider',
				'Illuminate\Hashing\HashServiceProvider',
				'Illuminate\Mail\MailServiceProvider',
				'Illuminate\Pagination\PaginationServiceProvider',
				'Illuminate\Pipeline\PipelineServiceProvider',
				'Illuminate\Queue\QueueServiceProvider',
				'Illuminate\Redis\RedisServiceProvider',
				'Illuminate\Auth\Passwords\PasswordResetServiceProvider',
				'Illuminate\Session\SessionServiceProvider',
				'Illuminate\Translation\TranslationServiceProvider',
				'Illuminate\Validation\ValidationServiceProvider',
				'Illuminate\View\ViewServiceProvider',

		/*
		 * Application Service Providers...
		 */
				'App\Providers\AppServiceProvider',
				'App\Providers\ConfigServiceProvider',
				'App\Providers\EventServiceProvider',
				'App\Providers\ForumServiceProvider',
				'App\Providers\ForumFrontendServiceProvider',
				'App\Providers\HelperServiceProvider',
				'App\Providers\RouteServiceProvider',
				'App\Providers\ViewComposerServiceProvider',
		/*
		 *
		 * Module service providers...
		 * */
				Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,
				'Kris\LaravelFormBuilder\FormBuilderServiceProvider',
				'MartinBean\MenuBuilder\MenuBuilderServiceProvider',
				'Teepluss\Theme\ThemeServiceProvider',
				'SammyK\LaravelFacebookSdk\LaravelFacebookSdkServiceProvider',
				Bican\Roles\RolesServiceProvider::class,
				'Stevebauman\Location\LocationServiceProvider',
				'Thomaswelton\LaravelGravatar\LaravelGravatarServiceProvider',
				Caffeinated\Flash\FlashServiceProvider::class,
				'Tuurbo\AmazonPayment\AmazonPaymentServiceProvider' ,
				Mews\Captcha\CaptchaServiceProvider::class,
				'Orangehill\Iseed\IseedServiceProvider',
				'Maatwebsite\Excel\ExcelServiceProvider',
				PulkitJalan\Google\GoogleServiceProvider::class,
				\Conner\Likeable\LikeableServiceProvider::class,
				Collective\Html\HtmlServiceProvider::class,
				Unisharp\Ckeditor\ServiceProvider::class,
				Smorken\Errors\ErrorServiceProvider::class,
				vendocrat\Addresses\AddressesServiceProvider::class,
				Webpatser\Countries\CountriesServiceProvider::class,
				Orchestra\Parser\XmlServiceProvider::class,
				Barryvdh\DomPDF\ServiceProvider::class,
				Nitmedia\Wkhtml2pdf\L5Wkhtml2pdfServiceProvider::class,
				Collective\Bus\BusServiceProvider::class,
				Sleimanx2\Plastic\PlasticServiceProvider::class,
				'DougSisk\CountryState\CountryStateServiceProvider',

	],
 
	/*
	|--------------------------------------------------------------------------
	| Class Aliases
	|--------------------------------------------------------------------------
	|
	| This array of class aliases will be registered when this application
	| is started. However, feel free to register as many as you wish as
	| the aliases are "lazy" loaded so they don't hinder performance.
	|
	*/

	'aliases' => [
				'Address'   => vendocrat\Addresses\Facades\Addresses::class,
				'App' => 'Illuminate\Support\Facades\App',
				'AmazonPayment' => 'Tuurbo\AmazonPayment\AmazonPaymentFacade',
				'Artisan' => 'Illuminate\Support\Facades\Artisan',
				'Auth' => 'Illuminate\Support\Facades\Auth',
				'Blade' => 'Illuminate\Support\Facades\Blade',
				'Bus' => 'Illuminate\Support\Facades\Bus',
				'Cache' => 'Illuminate\Support\Facades\Cache',
				'Config' => 'Illuminate\Support\Facades\Config',
				'Cookie' => 'Illuminate\Support\Facades\Cookie',
				'Countries' => Webpatser\Countries\CountriesFacade::class,
				'CountryState' => DougSisk\CountryState\CountryStateFacade::class,
				'Crypt' => 'Illuminate\Support\Facades\Crypt',
				'DB' => 'Illuminate\Support\Facades\DB',
				'Eloquent' => 'Illuminate\Database\Eloquent\Model',
				'Event' => 'Illuminate\Support\Facades\Event',
				'Excel' => 'Maatwebsite\Excel\Facades\Excel',
				'Facebook' => 'SammyK\LaravelFacebookSdk\FacebookFacade',
				'File' => 'Illuminate\Support\Facades\File',
				'Flash' => Caffeinated\Flash\Facades\Flash::class,
				'Form' => Collective\Html\FormFacade::class,
				'FormBuilder' => 'Kris\LaravelFormBuilder\Facades\FormBuilder',
				'Gate' => Illuminate\Support\Facades\Gate::class,
				'Google' => PulkitJalan\Google\Facades\Google::class,
				'Gravatar' => 'Thomaswelton\LaravelGravatar\Facades\Gravatar',
				'Hash' => 'Illuminate\Support\Facades\Hash',
				'Html' => Collective\Html\HtmlFacade::class,
				'Input' => 'Illuminate\Support\Facades\Input',
				'Inspiring' => 'Illuminate\Foundation\Inspiring',
				'Lang' => 'Illuminate\Support\Facades\Lang',
				'Location' => 'Stevebauman\Location\Facades\Location',
				'Log' => 'Illuminate\Support\Facades\Log',
				'Mail' => 'Illuminate\Support\Facades\Mail',
				'Menu' => 'MartinBean\MenuBuilder\MenuFacade',
				'Password' => 'Illuminate\Support\Facades\Password',
				//'PDF' => Barryvdh\DomPDF\Facade::class,
				'PDF' => Nitmedia\Wkhtml2pdf\Facades\Wkhtml2pdf::class,
				'Queue' => 'Illuminate\Support\Facades\Queue',
				'Redirect' => 'Illuminate\Support\Facades\Redirect',
				'Redis' => 'Illuminate\Support\Facades\Redis',
				'Request' => 'Illuminate\Support\Facades\Request',
				'Response' => 'Illuminate\Support\Facades\Response',
				'Route' => 'Illuminate\Support\Facades\Route',
				'Schema' => 'Illuminate\Support\Facades\Schema',
				'Session' => 'Illuminate\Support\Facades\Session',
				'Socialize' => 'Laravel\Socialite\Facades\Socialite',
				'Storage' => 'Illuminate\Support\Facades\Storage',
				'Theme' => 'Teepluss\Theme\Facades\Theme',
				'URL' => 'Illuminate\Support\Facades\URL',
				'Validator' => 'Illuminate\Support\Facades\Validator',
				'View' => 'Illuminate\Support\Facades\View',
			    'XmlParser' => Orchestra\Parser\Xml\Facade::class,

		] 
];
