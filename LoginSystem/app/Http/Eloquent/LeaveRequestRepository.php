<?php

namespace App\Http\Eloquent;




use App\Http\Interfaces\LeaveRequestRepositoryInterface;
use App\Http\Resources\LeaveRequestResource;
use App\Models\LeaveRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeaveRequestRepository implements leaveRequestRepositoryInterface
{
    public function GetAllLeaveRequest()
    {
        $leaveRequest = LeaveRequests::all();

        return LeaveRequestResource::collection($leaveRequest);
    }

    public function AddNewLeaveRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'employee_id' => 'required|exists:employees,id',
            'start_date' => 'required|date|date_format:Y-m-d|after_or_equal:today',
            'end_date' => 'required|date|date_format:Y-m-d|after:start_date',
            'reason' => 'required|string|max:255',

        ]);


        if ($validator->fails()) {return response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422);
        }

        $leaveRequest = [
            'user_id' => $request->user_id,
            'employee_id' => $request->employee_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,


        ];

        $leaveRequest = LeaveRequests::create($leaveRequest);
        return response()->json(['$leaveRequest' => $leaveRequest], 201);

    }

    public function GetLeaveRequestByID($id)
    {
        $LeaveRequest = LeaveRequests::find($id);

        if (!$LeaveRequest) {
            return response()->json(['message' => 'LeaveRequest not found'], 404);
        }

        return new LeaveRequestResource($LeaveRequest);
    }

    public function DeleteLeaveRequestByID($id)
    {
        $LeaveRequest = LeaveRequests::find($id);

        if (!$LeaveRequest) {

            return response()->json(['message' => 'LeaveRequest not found'], 404);
        }

        $LeaveRequest->delete();
        return response()->json(['message' => 'LeaveRequest deleted successfully'], 200);
    }

    public function UpdateLeaveRequestByID($id,Request $request)
    {
        $LeaveRequest = LeaveRequests::find($id);

        if (!$LeaveRequest) {
            return response()->json(['message' => 'LeaveRequest not found'], 404);
        }

        $validator = Validator::make($request->all(), [

            'start_date' => 'required|date|date_format:Y-m-d|after_or_equal:today',
            'end_date' => 'required|date|date_format:Y-m-d|after:start_date',
            'reason' => 'required|string|max:255',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $leaveRequest_data = [
            'user_id' => $request->user_id,
            'employee_id' => $request->employee_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'updated_at' => now(),


        ];
        $LeaveRequest->update($request->all());
        return new LeaveRequestResource($LeaveRequest);
    }
}
