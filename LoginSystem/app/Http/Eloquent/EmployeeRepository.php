<?php

namespace App\Http\Eloquent;

use App\Http\Interfaces\EmployeeRepositoryInterface;
use App\Http\Resources\EmployeeResource;
use App\Models\AttendanceLog;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Eloquent\AttendanceLogRepository;

class EmployeeRepository implements EmployeeRepositoryInterface
{


    public function GetAllEmployees()
    {

        $Employee = Employee::all();

        return EmployeeResource::collection($Employee);

    }

    public function AddNewEmployee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string',
            'email' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'department_id' => 'required|integer|max:5',
            'position_id' => 'required|string|max:20',
            'salary' => 'required|string|max:20',

        ]);


        if ($validator->fails()) {return response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422);
        }

        $EmployeeData = [
            'first_name' => $request->first_name,
            'last_name' => $request->email,
            'email' => $request->email,
            'phone' => $request->phone,
            'department_id' => $request->department_id,
            'position_id' => $request->position_id,
            'salary' => $request->salary,

        ];

        $Employee = Employee::create($EmployeeData);
        return response()->json(['Employee' => $Employee], 201);
    }

    public function GetEmployeeByID($id)
    {

        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

         return new EmployeeResource($employee);
    }

    public function DeleteEmployeeByID($id)
    {
        $Employee = Employee::find($id);

        if (!$Employee) {

            return response()->json(['message' => 'Employee not found'], 404);
        }

        $Employee->delete();
        return response()->json(['message' => 'Employee deleted successfully'], 200);
    }

    public function UpdateEmployeeByID($id,Request $request)
    {
        $Employee = Employee::find($id);

        if (!$Employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string',
            'email' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'department_id' => 'required|integer|max:5',
            'position_id' => 'required|string|max:20',
            'salary' => 'required|string|max:20',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $Employee->update($request->all());
        return new EmployeeResource($Employee);
    }

    public function GetAllLog(Request $request)
    {
        //AttendanceLogRepository::class->CountAttendanceLogByID($request);

        if (empty($request->employee_id)) {
            return response()->json(['message' => 'Please enter employee_id'], 400);
        }


        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();


        $loginCount = AttendanceLog::where('employee_id', $request->employee_id)
            ->whereBetween('login_time', [$startDate, $endDate])
            ->count();


        if ($loginCount === 0) {
            return response()->json(['message' => 'Not found period this Employee_id'], 404);
        }

        return response()->json([
            'status' => 'success',
            'login_count' => $loginCount,
            'period' => [
                'start_date' => $startDate->toDateString(),
                'end_date' => $endDate->toDateString()
            ]
        ]);



    }
}
