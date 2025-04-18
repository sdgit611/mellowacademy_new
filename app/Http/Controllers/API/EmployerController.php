<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employer;
use App\Models\User;
use App\Models\DeveloperOrder;
use Illuminate\Support\Facades\Hash;

class EmployerController extends Controller
{
    public function employerLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $employer = Employer::where('email', $request->email)->first();

        if (!$employer) {
            return response()->json([
                'status' => false,
                'message' => 'Employer not found.'
            ], 404);
        }

        $inputPassword = $request->password;

        // First check with Hash::check (for bcrypt)
        if (Hash::check($inputPassword, $employer->password)) {
            // Matched using Hash::check
        }
        // Then fallback to legacy md5 check
        elseif ($employer->password === md5($inputPassword)) {
            // Optionally: Upgrade password to Hash::make() for future logins
            $employer->password = Hash::make($inputPassword);
            $employer->save();
        }
        else {
            return response()->json([
                'status' => false,
                'message' => 'Incorrect password.'
            ], 401);
        }

        return response()->json([
            'status' => true,
            'message' => 'Login successful.',
            'data' => [
                'id' => $employer->id,
                'email' => $employer->email,
                'name' => $employer->fname,
            ]
        ], 200);
    }

    public function employerProfile(Request $request)
    {  
        $employerId = $request->employerId;
        $data = User::find($employerId);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Profile fetched successfully.',
                'EmployerProfile' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Un-Authenticate Or Employer not found.'
            ], 404);
        }
    }
    
    public function employerResource(Request $request)
    {
        $employerId = $request->employerId;

        if (!$employerId) {
            return response()->json([
                'status' => false,
                'message' => 'Employer ID is required.',
            ], 400);
        }

        $employerResourceDetails = DeveloperOrder::with('developer')
            ->where('u_id', $employerId)
            ->orderBy('dev_id', 'desc')
            ->get();

        if ($employerResourceDetails->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Un-Authenticate Or No developer resources found for this employer ID.',
                'data' => []
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Developer resources retrieved successfully.',
            'data' => $employerResourceDetails
        ]);
    }

    public function employerOngoingResource(Request $request)
    {
        $employerLoginId = $request->employerId;

        if (!$employerLoginId) {
            return response()->json([
                'status' => false,
                'message' => 'employer login ID is required.',
            ], 400);
        }

        // Use Eloquent to fetch the ongoing resource details
        $ongoingResourceDetails = DeveloperOrder::with('developer')  // eager load the related developer
            ->where('u_id', $employerLoginId)
            ->whereHas('developer', function($query) {
                $query->where('developer_status', 'Booked');  // filter based on status 'Booked'
            })
            ->orderBy('dev_id', 'desc')
            ->get();

        if ($ongoingResourceDetails->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No ongoing developer resources found for this employer login ID.',
                'data' => []
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Ongoing developer resources retrieved successfully.',
            'data' => $ongoingResourceDetails
        ]);
    }
    
    public function employerCompletedResource(Request $request)
    {
        $employerLoginId = $request->employerId;

        if (!$employerLoginId) {
            return response()->json([
                'status' => false,
                'message' => 'Employer login ID is required.',
            ], 400);
        }

        $completedResourceDetails = DeveloperOrder::with('developer')
            ->where('u_id', $employerLoginId)
            ->where('payment_status', 'SUCCESS')
            ->orderBy('dev_id', 'desc')
            ->get();

        if ($completedResourceDetails->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No completed resources found for this employer login ID.',
                'data' => []
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Completed developer resources retrieved successfully.',
            'data' => $completedResourceDetails
        ]);
    }

    public function employerUpdatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:6',
            'confirm_password' => 'required|string|same:new_password',
        ]);

        $userId = $request->employerId;
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found.'
            ], 404);
        }

        $oldPassword = $request->old_password;
        $newPassword = $request->new_password;

        $isOldPasswordMatched = false;

        // Check both Hash and md5
        if (Hash::check($oldPassword, $user->password)) {
            $isOldPasswordMatched = true;
        } elseif ($user->password === md5($oldPassword)) {
            $isOldPasswordMatched = true;
        }

        if (!$isOldPasswordMatched) {
            return response()->json([
                'status' => false,
                'message' => 'Old password does not match.'
            ], 400);
        }

        // Update with Hash only
        $user->password = Hash::make($newPassword);
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Password changed successfully.'
        ]);
    }


}
