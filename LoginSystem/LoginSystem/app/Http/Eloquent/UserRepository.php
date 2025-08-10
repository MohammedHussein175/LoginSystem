<?php

namespace App\Http\Eloquent;


use App\Http\Interfaces\UserRepositoryInterface;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\UserResource;
use App\Models\AttendanceLog;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserRepository implements UserRepositoryInterface
{
    public function GetAllUsers()
    {
        $users = User::all();
        return UserResource::collection($users);
    }

    public function AddNewUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => [
                'required',
                'max:4',
                'unique:users,employee_id',
                'exists:employees,id',
            ],
            'user_name' => 'required',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $userData = [

            'employee_id' => $request->employee_id,
            'user_name' => $request->user_name,
            'password' => Hash::make($request->password),

        ];

        $user = User::create($userData);
        return new UserResource($user);
    }

    public function GetUserByID($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return new UserResource($user);
    }

    public function DeleteUserByID($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted Successfully'], 200);
    }

    public function UpdateUserByID($id, Request $request)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validator = Validator::make($request->all(), [

            'user_name' => 'required',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $updateData = $request->all();

        if ($request->has('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);
        return new UserResource($user);
    }


}
