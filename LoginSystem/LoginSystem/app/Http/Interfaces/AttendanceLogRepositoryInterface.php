<?php


namespace App\Http\Interfaces;
use Illuminate\Http\Request;

interface AttendanceLogRepositoryInterface
{
    public function GetAllAttendanceLog();

    public function GetAttendanceLogByID($id);
    public function LogIn(Request $request);
    public function LogOut(Request $request);
    public function DeleteAttendanceLogByID($id);

    public function CountAttendanceLogByID(Request $request);

}
