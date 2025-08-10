<?php
namespace App\Http\Interfaces;
use Illuminate\Http\Request;

interface LeaveRequestRepositoryInterface
{
    public function GetAllLeaveRequest();

    public function GetLeaveRequestByID($id);

    public function AddNewLeaveRequest(Request $request);

    public function UpdateLeaveRequestByID($id,Request $request);

    public function DeleteLeaveRequestByID($id);
}
