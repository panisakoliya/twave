<?php

namespace App\Http\Controllers;

use App\DataTables\UserDatatable;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('user.index');
    }

    public function updateStatus(Request $request)
    {
        $user = User::where('uuid', $request->uuid)->first();

        if (empty($user)) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => 'User not found!'
            ]);
        }

        if ($user->status == 'active') {
            $user->status = 'inactive';
        } else {
            $user->status = 'active';
        }
        $user->save();

        return response()->json([
            'status' => true,
            'data' => $user,
            'message' => 'Status updated'
        ]);
    }

    public function delete(Request $request)
    {
        $user = User::where('uuid', $request->uuid)->first();

        if (empty($user)) {
            return response()->json([
                'status' => false,
                'data' => '',
                'message' => 'User not found!'
            ]);
        }

        $user->delete();

        return response()->json([
            'status' => true,
            'data' => $user,
            'message' => 'User deleted successfully'
        ]);
    }
}
