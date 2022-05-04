<?php

namespace App\Http\Controllers\API;

use App\Helper\APIResponseHelper;
use App\Helper\ExtensionAllowedHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class UserAPIController extends Controller
{
    public function user(Request $request)
    {
        if (!Auth::user()) {
            return response()->json([
                'status' => false,
                'data' => '',
                'message' => 'User not found!'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => Auth::user(),
            'message' => 'User retrieved successfully!'
        ]);
    }

    public function forgotPassword(Request $request)
    {
        if (!$request->has('email') || $request->email == "") {
            return APIResponseHelper::apiErrorResponse("Email is required");
        }

        $checkEmail = User::where('email', $request->email)->first();

        if (empty($checkEmail)) {
            return APIResponseHelper::apiErrorResponse("Email does not exist");
        }

        try {
            $response = Password::sendResetLink($request->all());
            if ($response == Password::RESET_LINK_SENT) {
                return response()->json([
                    'status' => true,
                    'data' => '',
                    'message' => 'We have emailed your password reset link!'
                ]);
            } else {
                return APIResponseHelper::apiErrorResponse("Email could not be sent to this email address");
            }
        } catch (\Exception $e) {
            return APIResponseHelper::apiErrorResponse($e->getMessage());
        }
    }

    public function updatePassword(Request $request)
    {
        if (!$request->has('password') || $request->password == "") {
            return APIResponseHelper::apiErrorResponse("Password is required");
        }

        if ((Hash::check(request('password'), Auth::user()->password)) == false) {
            return APIResponseHelper::apiErrorResponse("Old password is invalid");
        }

        if (!$request->has('new_password') || $request->new_password == "") {
            return APIResponseHelper::apiErrorResponse("New password is required");
        }

        if ((Hash::check(request('new_password'), Auth::user()->password)) == true) {
            return APIResponseHelper::apiErrorResponse("Old password and new password not be same");
        }

        $user = Auth::user();
        $user->password = bcrypt($request->new_password);
        $user->save();

        return response()->json([
            'status' => true,
            'data' => $user,
            'message' => 'Password updated successfully'
        ]);
    }
}
