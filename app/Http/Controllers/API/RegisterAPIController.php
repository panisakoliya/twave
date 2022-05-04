<?php

namespace App\Http\Controllers\API;

use App\Helper\APIResponseHelper;
use App\Helper\ExtensionAllowedHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RegisterAPIController extends Controller
{
    public function register(Request $request)
    {
        if (!$request->has('name') || $request->name == "") {
            return APIResponseHelper::apiErrorResponse("Name field is required");
        }

        if (!$request->has('email') || $request->email == "") {
            return APIResponseHelper::apiErrorResponse("Email field is required");
        }

        if (!$request->has('address') || $request->address == "") {
            return APIResponseHelper::apiErrorResponse("Address field is required");
        }

        if (!$request->has('phone_number') || $request->phone_number == "") {
            return APIResponseHelper::apiErrorResponse("Phone Number field is required");
        }

        $checkEmail = User::where('email', $request->email)->first();

        if ($checkEmail) {
            return APIResponseHelper::apiErrorResponse("Email is already has been taken!");
        }

        if (!$request->has('password') || $request->password == "") {
            return APIResponseHelper::apiErrorResponse("Password field is required");
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->api_token = Str::random(60);
        $user->save();

        $user->assignRole('user');

        return response()->json([
            'status' => true,
            'data' => $user,
            'message' => 'User register successfully'
        ]);
    }
}
