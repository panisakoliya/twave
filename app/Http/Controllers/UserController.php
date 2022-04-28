<?php

namespace App\Http\Controllers;

use App\DataTables\UserDatatable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    private $userImagePath;

    public function __construct()
    {
        $this->userImagePath = public_path('/assets/images/user_images');

        if (!File::isDirectory($this->userImagePath)) {
            File::makeDirectory($this->userImagePath, 0777, true, true);
        }
    }

    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('user.index');
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|max:10,min:6',
            'address' => 'required|string|max:255',
            'image' => 'required|file',
            'phone_number' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ]);

        $image = $request->file('image');
        $imageName = date('Y_m_d_h_i_s') . '__' . rand(100, 50000) . '.' . $image->getClientOriginalExtension();
        $request->image->move($this->userImagePath, $imageName);
        $user->image = $imageName;
        $user->save();

        $user->assignRole('user');

        return redirect()->route('user.index')->with(['success' => 'User stored successfully']);
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,' . $user->id,
            'password' => $request->has('password') && $request->password != "" ? 'required|string|max:10,min:6' : '',
            'address' => 'required|string|max:255',
            'image' => $request->has('image') && $request->image != "" ? 'required|file' : '',
            'phone_number' => 'required|string|max:255',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->has('password') && $request->password != "") {
            $user->password = $request->password;
        }
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;

        if ($request->has('image') && $request->image != "") {
            $image = $request->file('image');
            $imageName = date('Y_m_d_h_i_s') . '__' . rand(100, 50000) . '.' . $image->getClientOriginalExtension();
            $request->image->move($this->userImagePath, $imageName);
            $user->image = $imageName;
        }
        $user->save();

        return redirect()->route('user.index')->with(['success' => 'User updated successfully']);
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
            'data' => '',
            'message' => 'User deleted successfully'
        ]);
    }
}
