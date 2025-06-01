<?php

namespace App\Http\Controllers;

use App\Http\Eloquent\AttendanceLogRepository;
use App\Models\AttendanceLog;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AttendanceLogController extends Controller
{

    private $attendanceLogRepository;
    public function __construct(AttendanceLogRepository $attendanceLogRepository)
    {
        return $this->attendanceLogRepository = $attendanceLogRepository;
    }
    public function GetAll()
    {

      return  $this->attendanceLogRepository->GetAllAttendanceLog();

    }


    public function LogIn(Request $request)
    {
        return $this->attendanceLogRepository->LogIn($request);

    }


    public function Logout(Request $request)
    {

        return $this->attendanceLogRepository->Logout($request);

    }


    public function FindByID(Request $request)
    {
        return $this->attendanceLogRepository->GetAttendanceLogByID($request->id);

    }


    public function UpdateByID(Request $request)
    {
        return $this->attendanceLogRepository->Update($request->id,$request);
    }


    public function DeleteByID(Request $request)
    {
        return $this->attendanceLogRepository->DeleteAttendanceLogByID($request->id);
    }
}
