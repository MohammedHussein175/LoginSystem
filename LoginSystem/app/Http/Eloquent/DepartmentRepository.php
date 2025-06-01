<?php

namespace App\Http\Eloquent;


use App\Http\Interfaces\DepartmentRepositoryInterface;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DepartmentRepository implements DepartmentRepositoryInterface
{
    public function GetAllDepartment()
    {
        $departments = Department::all();
        return response()->json($departments);
    }

    public function AddNewDepartment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department_name' => 'required|string|max:100|unique:departments,department_name',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $departmentData = [
            'department_name' => $request->department_name,

        ];

        $department = Department::create($departmentData);
        return response()->json(['department' => $department], 201);
    }

    public function GetDepartmentByID($id)
    {
        $department = Department::find($id);

        if (!$department) {
            return response()->json(['message' => 'Department not found'], 404);
        }

        return response()->json($department);
    }
    public function DeleteDepartmentByID($id)
    {
        $department = Department::find($id);

        if (!$department) {
            return response()->json(['message' => 'Department not found'], 404);
        }

        $department->delete();
        return response()->json(['message' => 'Department deleted successfully'], 200);
    }

    public function UpdateDepartmentByID($id, Request $request)
    {
        $department = Department::find($id);

        if (!$department) {
            return response()->json(['message' => 'Department not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'department_name' => 'required|string|max:100|unique:departments,department_name',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $department->update($request->all());
        return response()->json($department);
    }
}
