<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Developer;

class DeveloperProfileController extends Controller
{
    
    public function developerLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $developer = DB::table('developer_details_tb')->where('email', $request->email)->first();

        if ($developer && Hash::check($request->password, $developer->password)) {
            // Store developer session
            Session::put('developer_login_id', $developer->dev_id);
            Session::put('developer_email_login', $developer->email);
            Session::put('developer_name_login', $developer->name);

            return response()->json([
                'status' => true,
                'message' => 'Login Successfully.',
                'developer_id' => $developer->dev_id,
                'developer_name' => $developer->name,
                'developer_email' => $developer->email,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Login Failed. Username or password is incorrect.',
        ], 401);
    }

    public function developerData($developerId)
    {
        $developer_details = DB::table('developer_details_tb')
            ->where('dev_id', $developerId)
            ->get();

        $developer_project_details = DB::table('developer_project_details_tb')
            ->where('developer_id', $developerId)
            ->get();

        return [
            'developer_details' => $developer_details,
            'developer_project_details' => $developer_project_details,
        ];
    }

     /**
     * Developer Profile
     */
    public function developerProfile(Request $request)
    {
        $developer_id = $request->developer_id;

        if (!$developer_id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized. Please login first.',
            ], 401);
        }

        $developer_details = DB::table('developer_details_tb')
            ->where('dev_id', $developer_id)
            ->first();

        $developer_project_details = DB::table('developer_project_details_tb')
            ->where('developer_id', $developer_id)
            ->get();

        $premium_profile_details = DB::table('premium_order_tb')
            ->where('dev_id', $developer_id)
            ->count();

        $joined_details = DB::table('developer_details_tb')
            ->select(
                'higher_professional_tb.id as ids',
                'higher_professional_tb.heading',
                'developer_details_tb.dev_id',
                'developer_details_tb.pro_id',
                'developer_details_tb.name',
                'developer_details_tb.last_name',
                'developer_details_tb.description',
                'developer_details_tb.image',
                'developer_details_tb.phone',
                'developer_details_tb.email',
                'developer_details_tb.job',
                'developer_details_tb.perhr',
                'developer_details_tb.total_hours',
                'developer_details_tb.rating',
                'developer_details_tb.address',
                'developer_details_tb.language',
                'developer_details_tb.education',
                'developer_details_tb.skills',
                'developer_details_tb.completed_job',
                'developer_details_tb.portfolio_image',
                'developer_details_tb.resume',
                'developer_details_tb.developer_status',
                'developer_details_tb.show_password',
                'developer_details_tb.available_start_date',
                'developer_details_tb.available_end_date'
            )
            ->join('higher_professional_tb', 'higher_professional_tb.id', '=', 'developer_details_tb.pro_id')
            ->where('developer_details_tb.dev_id', $developer_id)
            ->get();

        return response()->json([
            'status' => true,
            'developer_details' => $developer_details,
            'developer_project_details' => $developer_project_details,
            'premium_profile_count' => $premium_profile_details,
            'joined_details' => $joined_details,
        ]);
    }

    public function developerKyc(Request $request)
    {   $developerId = $request->developerId;
        $kyc = $this->developerData($developerId);
        return response()->json([
            'status' => true,
            'kyc' => $kyc,
        ]);
    }
    
    public function developerWalletDetails(Request $request)
    {   $developerId = $request->developerId;
        $developerWalletMilestone = DB::table('milestone_tb')
        ->select('developer_details_tb.dev_id','developer_details_tb.perhr','developer_details_tb.pro_id','milestone_tb.milestone_name','milestone_tb.days','milestone_tb.dev_id','milestone_tb.dev_id','milestone_tb.id')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'milestone_tb.dev_id')
        ->where('developer_details_tb.dev_id',$developerId)
        ->get();

        $commissionDetails = DB::table('commission_tb')->get();
        return response()->json([
            'status' => true,
            'developerWalletMilestone' => $developerWalletMilestone,
            'commissionDetails' => $commissionDetails,
        ]);
    }

    public function updatePassword(Request $request)
    {
        try {
            $request->validate([
                'developerId' => 'required|exists:developer_details_tb,dev_id',
                'old_password' => 'required',
                'new_password' => 'required|min:6',
                'confirm_password' => 'required|same:new_password',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);
        }

        $developer = Developer::find($request->developerId);

        if (!$developer) {
            return response()->json([
                'status' => false,
                'message' => 'Developer not found.'
            ], 404);
        }

        if (!Hash::check($request->old_password, $developer->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Old password does not match.'
            ], 401);
        }

        $developer->password = Hash::make($request->new_password);
        $developer->save();

        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully.'
        ], 200);
    }
}