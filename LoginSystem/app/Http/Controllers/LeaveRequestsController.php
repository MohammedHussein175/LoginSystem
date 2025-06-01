<?php

namespace App\Http\Controllers;

use App\Http\Eloquent\LeaveRequestRepository;
use App\Models\LeaveRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LeaveRequestsController extends Controller
{

  protected  $leaveRequestRepository;

    public function __construct(LeaveRequestRepository $leaveRequestRepository)
    {
        $this->leaveRequestRepository = $leaveRequestRepository;
    }

    public function GetAll()
    {
       return $this->leaveRequestRepository->GetAllLeaveRequest();
    }


    public function AddNew(Request $request)
    {
        return $this->leaveRequestRepository->AddNewLeaveRequest($request);
    }


    public function FindByID(Request $request)
    {
        return $this->leaveRequestRepository->GetLeaveRequestByID($request->id);
    }


    public function UpdateByID( Request $request)
    {
       return $this->leaveRequestRepository->UpdateLeaveRequestByID($request->id, $request);
    }


    public function DeleteByID(Request $request)
    {
        return $this->leaveRequestRepository->DeleteLeaveRequestByID($request->id);
    }

}
