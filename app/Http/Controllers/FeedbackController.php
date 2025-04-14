<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function index()
{
    return view('feedback');
}

public function store(Request $request)
{
    $feedback = Feedback::create([
        'communication_score' => $request->communication_score,
        'communication_remark' => $request->communication_remark,
        'coding_score' => $request->coding_score,
        'coding_remark' => $request->coding_remark,
        'status' => $request->status
    ]);

    // if ($request->status === 'rejected') {
    //     Mail::raw("A candidate was rejected. Remarks:\n{$request->communication_remark}\n{$request->coding_remark}", function ($message) {
    //         $message->to('admin@example.com')
    //                 ->subject('Candidate Rejected');
    //     });
    // }

    return redirect()->back()->with('success', 'Feedback submitted.');
}
}
