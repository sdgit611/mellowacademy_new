<?php

namespace App\Services;

use Carbon\Carbon;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Google_Service_Calendar_ConferenceData;
use Illuminate\Support\Facades\Session;


class GoogleCalendarService
{
    protected $client;
    protected $service;

    public function __construct()
    {
        $this->client = new \Google_Client();
        $this->client->setAuthConfig(storage_path('app/google-calendar-credentials.json'));
        $this->client->addScope(\Google_Service_Calendar::CALENDAR);
        $this->client->setAccessType('offline');

        if (Session::has('google_calendar_token')) {
            $this->client->setAccessToken(Session::get('google_calendar_token'));

            if ($this->client->isAccessTokenExpired()) {
                if ($this->client->getRefreshToken()) {
                    $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
                    Session::put('google_calendar_token', $this->client->getAccessToken());
                } else {
                    // token expired and no refresh token, force re-login
                    $this->client = null;
                    return;
                }
            }

            $this->service = new \Google_Service_Calendar($this->client);
        } else {
            // No token in session
            $this->client = null;
            $this->service = null;
        }
    }


    public function createInterviewEvent($name, $email, $dateTime)
    {
        
        $start = Carbon::parse($dateTime);
        $end = (clone $start)->addMinutes(30); // default 30 minutes

        $event = new Google_Service_Calendar_Event([
            'summary' => 'Interview with ' . $name,
            'start' => new Google_Service_Calendar_EventDateTime([
                'dateTime' => $start->toRfc3339String(),
                'timeZone' => 'Asia/Kolkata',
            ]),
            'end' => new Google_Service_Calendar_EventDateTime([
                'dateTime' => $end->toRfc3339String(),
                'timeZone' => 'Asia/Kolkata',
            ]),
            'attendees' => [['email' => $email]],
            'conferenceData' => [
                'createRequest' => [
                    'conferenceSolutionKey' => ['type' => 'hangoutsMeet'],
                    'requestId' => uniqid(),
                ]
            ],
        ]);


        $event = $this->service->events->insert('primary', $event, [
            'conferenceDataVersion' => 1,
        ]);

        return $event->getHangoutLink(); // returns Google Meet link
    }
}
