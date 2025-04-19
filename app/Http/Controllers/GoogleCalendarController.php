<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller; // ✅ Add this line
use Google\Client as Google_Client;
use Google\Service\Calendar as Google_Service_Calendar;



class GoogleCalendarController extends Controller
{
    public function redirectToGoogle()
    {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('app/google-calendar-credentials.json'));
        $client->addScope(Google_Service_Calendar::CALENDAR);
        $client->setAccessType('offline');
        $client->setPrompt('consent');
        $client->setRedirectUri(route('google.callback'));

        $authUrl = $client->createAuthUrl();
        return redirect($authUrl);
    }

    public function handleGoogleCallback(Request $request)
    {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('app/google-calendar-credentials.json'));
        $client->setRedirectUri(route('google.callback'));
        $client->addScope(Google_Service_Calendar::CALENDAR);

        if ($request->has('code')) {
            $token = $client->fetchAccessTokenWithAuthCode($request->code);
            Session::put('google_calendar_token', $token);

            return redirect()->route('success')->with('success', 'Google Calendar connected!');
        }

        return redirect()->route('success')->with('error', 'Failed to connect to Google Calendar.');
    }
}
