<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route;
use App\Services\GoogleCalendar;
use App\Event;
use Illuminate\Support\Facades\Request;

class GoogleController extends Controller {
	public function show($calendarId, GoogleCalendar $calendar){
		$result = $calendar->get($calendarId);
		return response()->json($result);
	}
}