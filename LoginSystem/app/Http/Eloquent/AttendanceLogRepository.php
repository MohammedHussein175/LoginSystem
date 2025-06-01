<?php

namespace App\Http\Eloquent;

use App\Http\Interfaces\AttendanceLogRepositoryInterface;
use App\Http\Resources\AttendanceLogResource;
use App\Models\AttendanceLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceLogRepository implements AttendanceLogRepositoryInterface
{
    public function GetAllAttendanceLog()
    {
        $attendanceLogs = AttendanceLog::all();
        return AttendanceLogResource::collection($attendanceLogs);
    }

    public function LogIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:employees,id',
            'employee_id' => 'required|exists:employees,id',

        ]);


        if ($validator->fails()) {return response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422);
        }

        $LogData = [
            'user_id' => $request->user_id,
            'employee_id' => $request->employee_id,
            'login_time' => now(),
        ];

        $AttendanceLog = AttendanceLog::create($LogData);
        return response()->json(['AttendanceLog' => $AttendanceLog], 201);


    }

    public function LogOut(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:employees,id',
            'employee_id' => 'required|exists:employees,id',

        ]);


        if ($validator->fails()) {return response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422);
        }

        $LogData = [
            'user_id' => $request->user_id,
            'employee_id' => $request->employee_id,
            'logout_time' => now(),
        ];

        $AttendanceLog = AttendanceLog::create($LogData);
        return response()->json(['AttendanceLog' => $AttendanceLog], 201);


    }


    public function GetAttendanceLogByID($id)
    {
        $attendanceLog = AttendanceLog::find($id);

        if (!$attendanceLog) {
            return response()->json(['message' => 'Attendance log not found'], 404);
        }

         return response()->json(['attendance_log' => $attendanceLog], 200);
    }

    public function DeleteAttendanceLogByID($id)
    {
        $attendanceLog = AttendanceLog::find($id);

        if($id=="")
        {
            return response()->json(['message' => 'Please enter by ID'], 404);
        }

        if (!$attendanceLog) {
            return response()->json(['message' => 'Attendance log not found'], 404);
        }

        $attendanceLog->delete();
        return response()->json(['message' => 'Attendance log deleted successfully'], 200);
    }

    public function CountAttendanceLogByID(Request $request)
    {
//        if (empty($request->employee_id)) {
//            return response()->json(['message' => 'Please enter employee_id'], 400);
//        }
//
//
//        $validator = Validator::make($request->all(), [
//            'start_date' => 'required|date',
//            'end_date' => 'required|date|after_or_equal:start_date',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json(['errors' => $validator->errors()], 422);
//        }
//
//
//        $startDate = Carbon::parse($request->start_date)->startOfDay();
//        $endDate = Carbon::parse($request->end_date)->endOfDay();
//
//
//        $loginCount = AttendanceLog::where('employee_id', $request->employee_id)
//            ->whereBetween('login_time', [$startDate, $endDate])
//            ->count();
//
//
//        if ($loginCount === 0) {
//            return response()->json(['message' => 'Not found period this Employee_id'], 404);
//        }
//
//        return response()->json([
//            'status' => 'success',
//            'login_count' => $loginCount,
//            'period' => [
//                'start_date' => $startDate->toDateString(),
//                'end_date' => $endDate->toDateString()
//            ]
//        ]);
    }

}
