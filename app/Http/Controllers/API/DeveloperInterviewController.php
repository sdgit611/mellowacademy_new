<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeveloperOrder;
use App\Models\DeveloperInterviewSchedule;
use App\Services\GoogleCalendarService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class DeveloperInterviewController extends Controller
{
    public function scheduleInterview(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'interviewdateone' => 'required|date',
            'from_time' => 'required',
            'to_time' => 'required',
        ]);

        $developerOrder = DeveloperOrder::where('dev_id', $request->developerId)->first();

        if (!$developerOrder) {
            return response()->json(['message' => 'Developer not found'], 404);
        }

        $calendar = new GoogleCalendarService();
        $meetLink = $calendar->createInterviewEvent(
            $request->name,
            $request->email,
            $request->interviewdateone
        );

        // Create interview schedule
        DeveloperInterviewSchedule::create([
            'dev_id' => $developerId,
            'u_id' => $developerOrder->u_id,
            'fname' => $request->name,
            'lname' => $developerOrder->lname,
            'phone' => $developerOrder->phone,
            'email' => $request->email,
            'perhr' => $developerOrder->perhr,
            'code' => $developerOrder->code,
            'address_one' => $developerOrder->address_one,
            'language' => $developerOrder->language ?? '',
            'interviewdateone' => $request->interviewdateone,
            'interviewdatetwo' => $request->from_time,
            'interviewdatethree' => $request->to_time,
            'from_time' => $request->from_time,
            'to_time' => $request->to_time,
            'meet_link' => $meetLink,
            'interviewlink' => $meetLink,
            'schinterviewdatetime' => now(),
            'status' => 'Scheduled',
            'approve_status' => 'Pending',
        ]);

        $developerOrder->update([
            'interviewdateone' => $request->interviewdateone,
            'interviewdatetwo' => $request->from_time,
            'interviewdatethree' => $request->to_time,
            'interviewlink' => $meetLink,
        ]);

        $htmlContent = "
            <h2>Interview Scheduled</h2>
            <p><strong>Candidate:</strong> {$request->name}</p>
            <p><strong>Email:</strong> {$request->email}</p>
            <p><strong>Date:</strong> {$request->interviewdateone}</p>
            <p><strong>Time:</strong> {$request->from_time} - {$request->to_time}</p>
            <p><strong>Google Meet Link:</strong> <a href='{$meetLink}'>{$meetLink}</a></p>
            <br><p>Thanks,</p>
        ";

        $recipients = [
            'admin@email.com',
            $developerOrder->email,
            $request->email,
        ];

        foreach ($recipients as $to) {
            if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
                Log::warning("Invalid email skipped: " . json_encode($to));
                continue;
            }

            Mail::html($htmlContent, function ($message) use ($to) {
                $message->to($to)->subject('Interview Scheduled');
            });
        }

        return response()->json([
            'success' => true,
            'message' => 'Interview scheduled successfully and emails sent.',
            'meet_link' => $meetLink,
        ]);
    }
}
