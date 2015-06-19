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

class GoogleController extends Controller {
}