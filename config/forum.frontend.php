<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Controllers
    |--------------------------------------------------------------------------
    |
    | Here we specify the namespace and controllers to use for the frontend.
    | Change these if you want to override default behaviour.
    |
    */

    'controllers' => [
        'namespace' => 'App\Http\Controllers\Forum\Frontend',
        'category'  => 'CategoryController',
        'thread'    => 'ThreadController',
        'post'      => 'PostController'
    ],

    /*
    |--------------------------------------------------------------------------
    | Utility Class
    |--------------------------------------------------------------------------
    |
    | Here we specify the namespace of the class to use for various utility
    | methods. This is automatically aliased to 'Forum' for ease of use in
    | views.
    |
    */

    'utility_class' => App\Forum::class,

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | Here we specify middleware to apply to the routes. For multiple values,
    | use arrays or pipe notation.
    |
    */

    'middleware' => ['auth' => 'App\Http\Middleware\Authenticate']

];
