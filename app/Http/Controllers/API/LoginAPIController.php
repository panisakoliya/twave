<?php

namespace App\Http\Controllers\API;

use App\Helper\APIResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginAPIController extends Controller
{
    public function login(Request $request)
    {
        if (!$request->has('email') || $request->email == "") {
            return APIResponseHelper::apiErrorResponse("Email field is required");
        }

        if (!$request->has('password') || $request->password == "") {
            return APIResponseHelper::apiErrorResponse("Password field is required");
        }

        $user = User::where('email', $request->email)->first();

        if (empty($user)) {
            return APIResponseHelper::apiErrorResponse("Email does not exist");
        }

        if (!Hash::check($request->password, $user->password)) {
            return APIResponseHelper::apiErrorResponse("Email and password does not matched");
        }

        /** Update token when login **/
        $user->api_token = Str::random(60);
        $user->save();

        return response()->json([
            'status' => true,
            'data' => $user,
            'message' => 'User Logged in successfully.'
        ]);
    }

    public function logout()
    {
        if (Auth::check()) {
            $user = User::find(Auth::id());
            $user->api_token = null;
            $user->save();

            return response()->json([
                    'status' => true,
                    'data' => '',
                    'message' => 'Logout Success']
            );
        } else {
            return response()->json([
                    'status' => true,
                    'data' => '',
                    'message' => 'Something Went Wrong']
            );
        }
    }
}
